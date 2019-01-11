<?php

namespace BodenkoVV\AskQuestion\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package BodenkoVV\AskQuestion\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install bodenkovv_askquestion table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('bodenkovv_askquestion');
        if ($setup->getConnection()->isTableExists($tableName) !== true) {
            $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'question',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Question'
                )
                ->addColumn(
                    'answer',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Answer'
                )
                ->addColumn(
                    'question_date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Question Date'
                )
                ->addColumn(
                    'answer_date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Answer Date'
                )
                ->addColumn(
                    'product_url',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Product URL Question'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Name user'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Email user'
                )
                ->addColumn(
                    'phone',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Phone user'
                )
//                ->addColumn(
//                    'status',
//                    Table::TYPE_BOOLEAN,
//                    null,
//                    ['nullable' => true],
//                    'Status'
//                )
                ->setComment('Questions and Answers');
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}