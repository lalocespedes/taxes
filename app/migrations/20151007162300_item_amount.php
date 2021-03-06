<?php

use Phinx\Migration\AbstractMigration;

class ItemAmount extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $expenses_items = $this->table('invoice_item_amounts');
        $expenses_items->addColumn('invoice_item_id', 'integer')
                    ->addColumn('item_subtotal', 'decimal', array('precision' => 10, 'scale' => 2))
                    ->addColumn('item_total', 'decimal', array('precision' => 10, 'scale' => 2))
                    ->addColumn('created_at', 'timestamp')
                    ->addColumn('updated_at', 'timestamp', array('null'    => true,'default' => null))
                    ->addIndex('id')
                    ->addIndex('invoice_item_id')
                    ->create();
    }
}
