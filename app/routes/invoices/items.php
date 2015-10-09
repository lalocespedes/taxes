<?php

use lalocespedes\Calculators\TaxCalculator;
use lalocespedes\Models\Invoices\InvoiceItem;
use lalocespedes\Models\Invoices\InvoiceItemTax;
use lalocespedes\Models\Invoices\InvoiceItemAmount;
use lalocespedes\Models\Invoices\InvoiceAmount;

$app->get('/invoices/item', function() use($app) {

	$ItemPost = [

		'invoice_id'		=> 1,
		'item_name'			=> 'B0001',
		'item_description'	=> 'Bdescription',
		'item_qty'			=> 1,
		'item_price'		=> 1000,
		'item_unidad'		=> 'NA'

	];

	$TaxesPost = [1,4];

	$incluido = 1;


	//item store
	$item = InvoiceItem::create($ItemPost);

	//taxes store
	foreach ($TaxesPost as $key => $value) {

		InvoiceItemTax::create([
							
			'invoice_item_id'	=> $item->id,
			'tax_rate_id'		=> $value,
			'tax_rate_option'	=> $incluido

		]);
	}


	//calucate taxes

	//get taxes
	$taxes = InvoiceItemTax::where('invoice_item_id', $item->id)->with('tax_rates')->get();


	/**
	 * Calculate subtotal if taxes included
	 */
	if ($incluido) {

		foreach ($taxes as $key => $value) {
			
			$tax_incluided += $value->tax_rates->tax_rate_percent;

		}

		$ItemSubtotal = ($item->item_qty * $item->item_price / (($tax_incluided /100) + 1));
		
	} else {

		$ItemSubtotal = $item->item_qty * $item->item_price;

	}

	$calculatorTax = new TaxCalculator;
	$calculatorTax->setSubtotal($ItemSubtotal);

	foreach ($taxes as $key => $value) {
		
		$calculatorTax->addTax(
			$value->id,
			$value->tax_rates->tax_rate_percent
		);

	}

	$calculatorTax->calculate();

	//get taxes calculated
    $calculatedTaxes = $calculatorTax->getCalculatedTaxes();

    $calculatedTaxes['amounts'] = $calculatorTax->getCalculatedAmount();

    //update item tax amount
	foreach ($calculatedTaxes as $key => $value) {
		
		InvoiceItemTax::where('id', $value['id'])
						->update([
							'tax_amount'	=> $value['tax_amount']
						]);
	}

	//update item amounts

	InvoiceItemAmount::create([

		'invoice_item_id' => $item->id,
		'item_subtotal'		=> $calculatedTaxes['amounts']['subtotal'],
		'item_total'		=> $calculatedTaxes['amounts']['item_total']

	]);

	//dump($calculatedTaxes);

	//$item = InvoiceItem::where('id', $item->id)->with('ItemAmount')->with('ItemTax')->first();

	//dump($item);

	//update amount invoice

	$items_subtotal = InvoiceItem::with('ItemAmount')->where('id', $item->id)->first();
	$subtotal = $items_subtotal['ItemAmount']->sum('item_subtotal');

	$items_total = InvoiceItem::with('ItemAmount')->where('id', $item->id)->first();
	$total = $items_total['ItemAmount']->sum('item_total');

	InvoiceAmount::where('invoice_id', $ItemPost['invoice_id'])
			->update([
			'invoice_subtotal'	=> $subtotal,
			'invoice_total'		=> $total,
			'invoice_balance'	=> $total
	]);	

	//dump($items);

	echo "<br> finished";

})->name('invoices-items');
