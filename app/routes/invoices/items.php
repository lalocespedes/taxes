<?php

use lalocespedes\Calculators\TaxCalculator;
use lalocespedes\Models\Invoices\InvoiceItemTax;

$app->get('/invoices/item', function() use($app) {

	$ItemSubtotal = 1000;

	$invoiceItemId = 1;

	$taxes = InvoiceItemTax::where('invoice_item_id', $invoiceItemId)->with('tax_rates')->get();

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

    $calculatedTaxes = $calculatorTax->getCalculatedTaxes();

	foreach ($calculatedTaxes as $key => $value) {
		
		InvoiceItemTax::where('id', $value['id'])
						->update([
							'tax_amount'	=> $value['tax_amount']
						]);
	}

	echo "<br> finished";

})->name('invoices-items');
