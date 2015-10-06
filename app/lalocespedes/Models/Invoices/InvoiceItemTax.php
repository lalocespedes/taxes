<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;
/**
* 
*/
class InvoiceItemTax extends Eloquent
{
	
	protected $table = 'invoice_item_taxes';


	protected $fillable = [
		'invoice_item_id',
		'tax_rate_id',
		'item_description',
		'tax_rate_option',
		'tax_amount'
	];

	protected $attributes = [

		'tax_amount'		=> '0.00',
		'tax_rate_option'	=> 0
	];

	//relations
	public function tax_rates()
    {
    	return $this->belongsTo('lalocespedes\Models\Taxes\Taxes', 'tax_rate_id');
    }
}
