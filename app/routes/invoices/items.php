<?php

use lalocespedes\Calculators\TaxCalculator;
use lalocespedes\Models\Invoices\InvoiceItem;
use lalocespedes\Models\Invoices\InvoiceItemTax;

$app->get('/invoices/item', function() use($app) {

	$ItemPost = [

		'invoice_id'		=> 1,
		'item_name'			=> 'B0001',
		'item_description'	=> 'Bdescription',
		'item_qty'			=> 1,
		'item_price'		=> 2000,
		'item_unidad'		=> 'NA'

	];

	$TaxesPost = [1,4];

	$incluido = 0;


	//item store
	$item = InvoiceItem::create($ItemPost);

	$ItemSubtotal = $item->item_qty * $item->item_price;

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

	$calculatorTax = new TaxCalculator;
	$calculatorTax->setSubtotal($ItemSubtotal);

	foreach ($taxes as $key => $value) {
		
		$calculatorTax->addTax(
			$value->id,
			$value->tax_rates->tax_rate_percent,
			$value->tax_rate_option
		);

	}

	
	$calculatorTax->calculate();

	//get taxes calculated
    $calculatedTaxes = $calculatorTax->getCalculatedTaxes();

    //update item tax amount
	foreach ($calculatedTaxes as $key => $value) {
		
		InvoiceItemTax::where('id', $value['id'])
						->update([
							'tax_amount'	=> $value['tax_amount']
						]);
	}

	//update item amounts

	//get taxes calculated
    $calculatedAmounts = $calculatorTax->getCalculatedAmounts();

	echo "<br> finished";

})->name('invoices-items');
