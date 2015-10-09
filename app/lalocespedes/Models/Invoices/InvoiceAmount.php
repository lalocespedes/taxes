<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* 
*/
class InvoiceAmount extends Eloquent
{
	
	protected $table = 'invoice_amounts';

    protected $fillable = [
        'invoice_id',
        'invoice_subtotal',
        'invoice_total',
        'invoice_balance'

    ];

    protected $attributes = [
        'invoice_paid'        => '0.00',
    ];

	/*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
    public function InvoiceItem()
    {
    	return $this->belongsTo('lalocespedes\Models\Invoices\InvoiceItem');
    }
}