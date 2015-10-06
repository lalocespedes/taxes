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
	public function addTax($id, $tax_rate, $incluido)
	{
		$this->taxes[] = [
			'id'		=> $id,
			'tax_rate'	=> $tax_rate,
			'incluido'	=> $incluido
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
	* Returns calculated item amounts
	* @return array
	*/
	public function getCalculatedTaxes()
	{
		return $this->calculatedTaxes;
	}

	/**
	 * Calculates the taxes
	 */
	protected function calculateTaxes()
	{
		foreach ($this->taxes as $key => $value) {

			if (!$value['incluido']) {

				$tax = round($this->subtotal * ($value['tax_rate'] / 100), 2);

				$this->calculatedTaxes[] = [
                	'id'   			=> $value['id'],
                	'tax_amount'	=> $tax
                ];

			} else {

				$subtotal = ($this->subtotal / (($value['tax_rate']/100) + 1));

				$tax = round($subtotal * ($value['tax_rate'] / 100), 2);

				$this->calculatedTaxes[] = [
                	'id'   			=> $value['id'],
                	'tax_amount'	=> $tax
				];

			}

		}

	}

}
