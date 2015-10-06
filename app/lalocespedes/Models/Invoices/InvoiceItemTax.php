<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;
/**
* 
*/
class InvoiceItemTax extends Eloquent
{
	
	protected $table = 'invoice_item_taxes';


	//relations
	public function tax_rates()
    {
    	return $this->belongsTo('lalocespedes\Models\Taxes\Taxes', 'tax_rate_id');
    }
}
