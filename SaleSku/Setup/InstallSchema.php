<?php

namespace Actecnology\SaleSku\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    // public function getVersion()
    // {
    //     return '1.0.1'; 
    // }

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (!$installer->tableExists('actecnology_sale_sku')) { // validar que no exista la tabla para crearla
            $table = $installer->getConnection()
                ->newTable($installer->getTable('actecnology_sale_sku'))
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Sale ID'
                )
                ->addColumn(
                    'sku',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'SKU'
                )
                ->addColumn(
                    'offer_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Offer ID'
                )
                ->addColumn(
                    'order_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Order ID'
                )
                ->addColumn(
                    'quantity',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false],
                    'Sale Quantity'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addIndex(
                    $installer->getIdxName('actecnology_sale_sku', ['sku']),
                    ['sku']
                )
                ->addIndex(
                    $installer->getIdxName('actecnology_sale_sku', ['offer_id']),
                    ['offer_id']
                )
                ->addIndex(
                    $installer->getIdxName('actecnology_sale_sku', ['order_id']),
                    ['order_id']
                )
                ->setComment('Actecnology Sale SKU Table');

            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('actecnology_daily_sales_report')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('actecnology_daily_sales_report'))
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'ID'
                )
                ->addColumn(
                    'date',
                    Table::TYPE_DATE,
                    null,
                    ['nullable' => false],
                    'Date'
                )
                ->addColumn(
                    'sku',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'SKU'
                )
                ->addColumn(
                    'total_sales',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Total Sales'
                )
                ->addIndex(
                    $installer->getIdxName('actecnology_daily_sales_report', ['date', 'sku']),
                    ['date', 'sku']
                )
                ->setComment('Actecnology Daily Sales Report Table');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }    
}
