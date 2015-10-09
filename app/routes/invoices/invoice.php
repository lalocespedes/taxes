<?php

use lalocespedes\Models\Invoices\Invoice;
use lalocespedes\Models\Invoices\InvoiceItem;

$app->get('/invoices/:id', function($id) use($app) {

	$invoice = Invoice::with('Items.ItemTax')->where('id', $id)->get();

	//$taxes = InvoiceItem::with('ItemTax.tax_rates')->where('invoice_id', $id)->get();

	dump($invoice['items']);

	//$invoice = Invoice::with('items')->where('id', $id)->first();

	//dump($invoice['items']->sum('item_total'));
	//echo $invoice['items']->sum('item_price');

	// $invoice->items = InvoiceItem::where('invoice_id', $id)
	// 	->with('ItemAmount')
	// 	->with('ItemTax')
	// 	->get();


	// $invoice = InvoiceItem::where('invoice_id', $id)
	// 	->with('ItemAmount')
	// 	->sum('invoice_item_amounts.item_subtotal');

	// $invoices = Capsule::table('invoices')
	// 	->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
	// 	->join('invoice_item_amounts', 'invoice_items.id', '=', 'invoice_item_amounts.invoice_item_id')
	// 	->select(new Expression('sum(item_subtotal) as suma'))
	// 	->where('invoices.id','=', $id)
	// 	->first();

	// echo $invoices->suma;

});
