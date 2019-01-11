<?php

namespace BodenkoVV\AskQuestion\Setup;

use \Magento\Framework\Setup\UpgradeSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;
use \BodenkoVV\AskQuestion\Model\Question;

/**
 * Class UpgradeSchema
 * @package BodenkoVV\AskQuestion\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $tableName = $setup->getTable('bodenkovv_askquestion');
            $setup->getConnection()->addColumn(
                $tableName,
                'status',
                [
                    'type' => Table::TYPE_BOOLEAN,
                    'length' => null,
                    ['nullable' => false, 'default' => 'false'],
                    'default' => false,
                    'comment' => 'Status'
                ]
            );
        }
        $setup->endSetup();


        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.6', '<')) {
            $tableName = $setup->getTable('bodenkovv_askquestion');
            $setup->getConnection()->addColumn(
                $tableName,
                'store_id',
                [
                    'type' => Table::TYPE_SMALLINT,
                    'length' => 5,
                    ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                    'default' => 0,
                    'comment' => 'Store ID'
                ]
            );
        }
        $setup->endSetup();

        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.7', '<')) {
            $tableName = $setup->getTable('bodenkovv_askquestion');
            $setup->getConnection()
                ->modifyColumn(
                $tableName,
                'status',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 15,
                        ['nullable' => false, 'default' => Question::STATUS_PENDING],
                        'default' => false,
                        'comment' => 'Status'
                    ]
                )
                ->modifyColumn(
                    $tableName,
                'sku',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => 63,
                        ['nullable' => false],
                        'comment' => 'Sku'
                    ]
                )
                ->modifyColumn(
                    $tableName,
                    'product_name',
                    [
                        'type' => Table::TYPE_TEXT,
                        'length' => null,
                        ['nullable' => false],
                        'comment' => 'Product Name'
                    ]
                );
        }
        $setup->endSetup();

    }
}