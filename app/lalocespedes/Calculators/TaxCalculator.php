<?php

namespace lalocespedes\Calculators;

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
	* The subtotal of the item
	* @var int
	*/
	protected $subtotal;

	/**
	 * An array to store taxes
	 * var array
	 */
	protected $taxes = [];

	protected $calculatedTaxes = [];

	/**
	* An array to store overall calculated amounts
	* @var array
	*/
	protected $calculatedAmount = [];

	/**
	 * Sets the id
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Sets the subtotal
	 * @param float $subtotal
	 */
	public function setSubtotal($subtotal)
	{
		$this->subtotal = $subtotal;
	}

	/**
	* Adds a taxes for calculation
	* @param int $id
	* @param float $tax_rate
	* @param boolean $incluido
	*/
	public function addTax($id, $tax_rate)
	{	
		$this->taxes[] = [
			'id'		=> $id,
			'tax_rate'	=> $tax_rate / 100,
		];
	}

	/**
	 * Call the calculation methods
	 */
	public function calculate()
	{
		$this->calculateTaxes();
	}

	/**
	* Returns calculated item taxes
	* @return array
	*/
	public function getCalculatedTaxes()
	{
		return $this->calculatedTaxes;
	}

	/**
	* Returns calculated item amounts
	* @return array
	*/
	public function getCalculatedAmount()
	{
		return $this->calculatedAmount;
	}

	/**
	* Calculates the taxes
	*/
	protected function calculateTaxes()
	{
		foreach ($this->taxes as $key => $value) {

			$tax = round($this->subtotal * ($value['tax_rate']), 2);

			$this->calculatedTaxes[] = [
				'id'			=> $value['id'],
				'tax_amount'	=> $tax
			];

			$this->calculatedAmount['subtotal'] = $this->subtotal;
			$this->calculatedAmount['item_tax_total'] += $tax;

		}

		$this->calculatedAmount['item_total'] = $this->calculatedAmount['subtotal'] + $this->calculatedAmount['item_tax_total'];

	}

}
