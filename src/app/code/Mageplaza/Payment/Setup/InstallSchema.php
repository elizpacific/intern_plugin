<?php

namespace Mageplaza\Payment\Setup;

use Laminas\Text\Table\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if(!$installer->tableExists('magento_practice_table')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magento_practice_table')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'id'
                )
                ->addColumn(
                    'text',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable=>false'],
                    'some text'
                )
                ->addColumn(
                    'api_key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        255,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'api key'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'updated_at')
                ->setComment('Magento Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('magento_practice_table'),
                $setup->getIdxName(
                    $installer->getTable('magento_practice_table'),
                    ['id','text','api_key'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['id','text','api_key'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
            $installer->endSetup();
        }
    }
}
