<?php

use Phinx\Migration\AbstractMigration;

class Invoice extends AbstractMigration
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
            $table = $this->table('invoices');
            $table->addColumn('client_id', 'integer')
                  ->addColumn('user_id', 'integer')
                  ->addColumn('invoice_status_id', 'integer')
                  ->addColumn('invoice_date_entered', 'timestamp')
                  ->addColumn('invoice_due_date', 'timestamp')
                  ->addColumn('invoice_number', 'integer')
                  ->addColumn('invoice_notes', 'text')
                  ->addColumn('invoice_group_id', 'integer')
                  ->addColumn('timbrado', 'boolean', array('default' => '0'))
                  ->addColumn('invoice_moneda', 'string', array('limit' =>  255))
                  ->addColumn('invoice_metodopago', 'string', array('limit' =>  255))
                  ->addColumn('invoice_formapago', 'string', array('limit' =>  255))
                  ->addColumn('invoice_NumCtapago', 'string', array('limit' =>  50))
                  ->addColumn('invoice_UUID', 'string', array('limit' =>  255))
                  ->addColumn('invoice_qr', 'string', array('limit' =>  255))
                  ->addColumn('invoice_cadenaOriginalTFD', 'string', array('limit' =>  255))
                  ->addColumn('selloCFD', 'string', array('limit' =>  255))
                  ->addColumn('invoice_sello', 'string', array('limit' =>  255))
                  ->addColumn('noCertificadoSAT', 'string', array('limit' =>  255))
                  ->addColumn('noCertificado', 'string', array('limit' =>  255))
                  ->addColumn('tipoDeComprobante', 'string', array('limit' =>  255))
                  ->addColumn('invoice_banco', 'string', array('limit' =>  255))
                  ->addColumn('invoice_num_pedido', 'string', array('limit' =>  255))
                  ->addColumn('invoice_orden_compra', 'string', array('limit' =>  255))
                  ->addColumn('invoice_condiciones_pago', 'string', array('limit' =>  255))
                  ->addColumn('invoice_tiempo_entrega', 'string', array('limit' =>  255))
                  ->addColumn('tipocambio', 'decimal', array('precision' => 10, 'scale' => 2))
                  ->addColumn('invoice_date_cancel', 'timestamp')
                  ->addColumn('fechatimbrado', 'timestamp')
                  ->addColumn('created_at', 'timestamp')
                  ->addColumn('updated_at', 'timestamp', array('null'    => true,'default' => null))
                  ->addIndex('id')
                  ->addIndex('client_id')
                  ->addIndex('user_id')
                  ->create();
    }
}
