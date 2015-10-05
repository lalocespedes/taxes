<?php

namespace lalocespedes\Calculators;

use lalocespedes\Models\Taxes\Taxes;

/**
* 
*/
class TaxCalculator
{
	/**
	 * The id of the cfdi
	 * @var int
	 */
	protected $id;

	/**
	 * An array to store taxes
	 * var array
	 */
	protected $taxes = [];

	protected $calculatedAmount = [];

	public function __construct()
	{
		$this->calculatedTaxes = [
			'tax_amount'	=> 0
		];
	}

	/**
	 * Sets the id
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Adds a tax for calculation
	 * @param int $itemId
	 * @param float $quantity
	 * @param float $price
	 */
	public function addItem($itemId, $quantity, $price)
	{
		$this->taxes[] = [
			'itemId'	=> $itemId,
			'quantity'	=> $quantity,
			'price'		=> $price
		];
	}

	/**
	 * Call the calculation methods
	 */
	public function calculate()
	{
		$this->calculateTaxes;
	}

	public function calculateTaxes($subtotal, $taxes)
	{	
		foreach ($taxes as $key => $value) {

			$rate = Taxes::where('id', $value->tax_rate_id)->first()->tax_rate_percent;

			if (!$value->tax_rate_option) {
				
				$tax =  $subtotal * ($rate / 100);

				$array[] = [
					'id'			=> $value->id,
					'tax_amount' 	=> $tax
				];

			} else {

				$tax = ($subtotal / (($rate/100) + 1));

				$array[] = [
					'id'			=> $value->id,
					'tax_amount' 	=> $tax
				];

			}

		}

		return $array;
	}

}
