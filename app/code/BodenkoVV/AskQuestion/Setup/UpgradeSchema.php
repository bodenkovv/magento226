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
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $tableName = $setup->getTable('bodenkovv_askquestion');
            $setup->getConnection()->addColumn(
                $tableName,
                'product_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'length' => 5,
                    ['nullable' => false, 'default' => 0],
                    'default' => 0,
                    'comment' => 'Product ID'
                ]
            );
        }
        $setup->endSetup();
    }
}
