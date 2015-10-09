<?php

namespace lalocespedes\Models\Invoices;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Query\Expression as Expression;

/**
* 
*/
class Invoice extends Eloquent
{
	
	protected $table = 'invoices';

	/*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
	public function Items()
    {
    	return $this->hasMany('lalocespedes\Models\Invoices\InvoiceItem', 'invoice_id');
    }

	// public function subtotal()
	// {
	//     return $this->hasMany('lalocespedes\Models\Invoice_item')
	//        ->selectRaw('product_id, sum(available_stock) as aggregate')
	//        ->groupBy('product_id');
	// }

	public function subtotal($id)
	{
		// return $this->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
		// 	->join('invoice_item_amounts', 'invoice_items.id', '=', 'invoice_item_amounts.invoice_item_id')
		// 	//->select(new Expression('sum(item_subtotal) as suma'))
		// 	->where('invoices.id','=', $id)->sum('item_subtotal');

		// return $this->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
		// ->join('invoice_item_amounts', 'invoice_items.id', '=', 'invoice_item_amounts.invoice_item_id')
		// ->select(new Expression('sum(item_subtotal) as suma'))
		// ->where('invoices.id','=', $id)
		// ->get();
	}

}