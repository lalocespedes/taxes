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

	//relations
	public function ItemAmount()
    {
    	return $this->hasOne('lalocespedes\Models\Invoices\InvoiceItemAmount', 'invoice_item_id');
    }

    public function invoice()
    {
        return $this->belongsTo('lalocespedes\Models\Invoices\Invoice');
    }

    public function ItemTax()
    {
    	return $this->hasMany('lalocespedes\Models\Invoices\InvoiceItemTax', 'invoice_item_id');
    }
}