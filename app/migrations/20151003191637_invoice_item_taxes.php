<?php

use Phinx\Migration\AbstractMigration;

class InvoiceItemTaxes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $tax_rates = $this->table('invoice_item_taxes');
        $tax_rates->addColumn('invoice_item_id', 'integer')
                  ->addColumn('tax_rate_id', 'integer')
                  ->addColumn('tax_rate_option', 'integer')
                  ->addColumn('tax_amount', 'decimal', array('null' => true, 'precision' => 10, 'scale' => 2))
                  ->addColumn('created_at', 'timestamp')
                  ->addColumn('updated_at', 'timestamp', array('null' => true, 'default' => null))
                  ->addIndex('id')
                  ->create();
    }
}