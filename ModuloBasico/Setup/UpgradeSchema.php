<?php


namespace Actecnology\ModuloBasico\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '1.0.1') < 0)
        {
            $installer = $setup;

            $installer->startSetup();
            $connection = $installer->getConnection();

            // Install new table
            $table = $installer->getConnection()->newTable(
              $installer->getTable('actecnology_subscription')
            )->addColumn(
                'subscription_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Subscription Id'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Created at'
            )->addColumn(
                'update_at',
                Table::TYPE_TIMESTAMP,
                null,
                [],
                'Updated at'
            )->addColumn(
                'firstname',
                Table::TYPE_TEXT,
                64,
                ['nullable'=>false],
                'First name'
            )->addColumn(
                'lastname',
                Table::TYPE_TEXT,
                64,
                ['nullable'=>false],
                'Last name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                255,
                ['nullable'=>false],
                'Email address'
            )->addColumn(
                'status',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                    'default' => 'pending',
                ],
                'Status'
            )->addColumn(
                'message',
                Table::TYPE_TEXT,
                '64k',
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'Subscription Notes'
            )->addIndex(
                $installer->getIdxName('actecnology_subscription', ['email']),
                ['email']
            )->setComment(
                'Table Subscription'
            );

            $installer->getConnection()->createTable($table);

            $installer->endSetup();
        }
    }
}