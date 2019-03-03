<?php

/*
 * CRUD
 * https://www.mageplaza.com/magento-2-module-development/how-to-create-crud-model-magento-2.html
 */

namespace Marcin\Weather\Setup;

use Marcin\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable(WeatherInterface::TABLE);

        if (!$setup->getConnection()->isTableExists($tableName)) {
            $table = $setup->getConnection()->newTable($tableName)
                ->addColumn(
                    WeatherInterface::ID,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    WeatherInterface::FIELD_WEATHER,
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable'=>false
                    ],
                    'Weather'
                )
                ->addColumn(
                    WeatherInterface::FIELD_CREATED_AT,
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT
                    ],
                    'Created At'
                )
                ->setComment('Marcin Weather');

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}