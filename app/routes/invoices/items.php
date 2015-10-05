<?php

use lalocespedes\Calculators\TaxCalculator;
use lalocespedes\Models\Invoices\InvoiceItemTax;

$app->get('/invoices/item', function() use($app) {

	$ItemSubtotal = 1000;

	$invoiceItemId = 2;

	$taxes = InvoiceItemTax::where('invoice_item_id', $invoiceItemId)->get();

	$calculatorTax = new TaxCalculator;

	$taxes = $calculatorTax->calculateTaxes($ItemSubtotal, $taxes);

	foreach ($taxes as $key => $value) {
		
		InvoiceItemTax::where('id', $value['id'])
						->update([
							'tax_amount'	=> $value['tax_amount']
						]);
	}

	echo "<br> finished";

})->name('invoices-items');
