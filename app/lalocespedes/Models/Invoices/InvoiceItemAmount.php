<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class InvoiceItemAmount extends Eloquent
{
	protected $table = 'invoice_item_amounts';

	protected $fillable = [
		'invoice_item_id',
		'item_subtotal',
		'item_total'
	];

	protected $attributes = [

		'item_subtotal'	=> '0.00',
		'item_total'	=> '0.00'
	];
}	