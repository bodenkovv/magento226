<?php

namespace BodenkoVV\AskQuestion\Setup;

use \Magento\Framework\Setup\InstallDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package BodenkoVV\AskQuestion\Setup
 */
class InstallData implements InstallDataInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** Install messages */
            $data = [
                [
                    'question' => 'Доброго дня, скажіть будь ласка чи варто очікувати в продажі дану модель у жовтому відтінку? Дякую.',
                    'answer' => '',
                    'product_url' => 'https://magento226.local/mars-heattech-trade-pullover.html',
                    'name' => 'Dimon',
                    'email' => 'dimon@geekhub.ck.ua',
                    'phone' => '+380932231111',
                ],
                [
                    'question' => 'Здравствуйте! На сколько месяцев доступна рассрочка',
                    'answer' => '',
                    'product_url' => 'https://magento226.local/mars-heattech-trade-pullover.html',
                    'name' => 'Alexey',
                    'email' => 'alexey@geekhub.ck.ua',
                    'phone' => '+380932231112',
                ],
            ];

        foreach ($data as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('bodenkovv_askquestion'), $bind);
        }
    }
}