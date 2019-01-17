<?php

namespace BodenkoVV\AskQuestion\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \BodenkoVV\AskQuestion\Model\Question;

/**
 * Class UpgradeData
 * @package BodenkoVV\AskQuestion\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample question in table bodenkovv_askquestion
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $version='0.0.2';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            $tableName = $setup->getTable('bodenkovv_askquestion');

            $data = [
                [
                    'question' => 'Добрый день, подскажите , а на эту модель будут акции в январе - феврале 2019?',
                    'answer' => '',
                    'product_url' => 'https://magento226.local/mars-heattech-trade-pullover.html',
                    'name' => 'Maxim',
                    'email' => 'maxim@geekhub.ck.ua',
                    'phone' => '+380932231113',
                    'status' => false,
                ],
            ];
            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);

            $setup
                ->getConnection()
                ->update($tableName, ['status' => false], 'name IN (\'Dimon\',\'Alexey\')');
        }
        $setup->endSetup();

        $version='0.0.5';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            $tableName = $setup->getTable('bodenkovv_askquestion');

            $setup
                ->getConnection()
                ->update($tableName, ['status' => false], 'status=1');
        }
        $setup->endSetup();


        $version='0.0.6';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            $tableName = $setup->getTable('bodenkovv_askquestion');

            $setup
                ->getConnection()
                ->update($tableName, ['store_id' => 0]);
        }
        $setup->endSetup();

        $version='0.0.7';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            $tableName = $setup->getTable('bodenkovv_askquestion');

            $setup
                ->getConnection()
                ->update($tableName, ['status' => Question::STATUS_PENDING]);
        }
        $setup->endSetup();

        $version='0.0.8';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            $tableName = $setup->getTable('bodenkovv_askquestion');

            $setup
                ->getConnection()
                ->update($tableName, ['store_id' => 1],'store_id=0');
        }
        $setup->endSetup();

    }
}
