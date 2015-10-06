<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class InvoiceItem extends Eloquent
{
	protected $table = 'invoice_items';

	protected $fillable = [
		'invoice_id',
		'item_name',
		'item_description',
		'item_qty',
		'item_price',
		'item_unidad'
	];

}