<?php

namespace BodenkoVV\AskQuestion\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \BodenkoVV\AskQuestion\Model\Question;
use Magento\Framework\Component\ComponentRegistrar;
use \Magento\Framework\File\Csv;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Store\Model\Store;

/**
 * Class UpgradeData
 * @package BodenkoVV\AskQuestion\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Csv
     */
    private $csv;

    /**
     * @var ComponentRegistrar
     */
    private $componentRegistrar;

    /**
     * UpgradeData constructor.
     * @param \BodenkoVV\AskQuestion\Model\QuestionFactory $questionFactory
     * @param ComponentRegistrar $componentRegistrar
     * @param Csv $csv
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \BodenkoVV\AskQuestion\Model\QuestionFactory $questionFactory,
        ComponentRegistrar $componentRegistrar,
        Csv $csv,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->componentRegistrar = $componentRegistrar;
        $this->csv = $csv;
        $this->questionFactory = $questionFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Creates sample question in table bodenkovv_askquestion
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $version='1.0.2';
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

        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0) {
            $this->updateDataForRequestSample($setup, 'import_data.csv');
        }

            if (version_compare($context->getVersion(), '1.0.2') < 0) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'allow_ask_questions');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'allow_to_ask_questions',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Allow to ask questions',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => 1,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
                ]
            );
        }
        $setup->endSetup();

        $version='1.0.2';
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

    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param $fileName
     * @throws \Exception
     */
    public function updateDataForRequestSample(ModuleDataSetupInterface $setup, $fileName)
    {
        $tableName = $setup->getTable('bodenkovv_askquestion');
        $file_path = $this->getPathToCsvMagentoAtdec($fileName);
        $csvData = $this->csv->getData($file_path);
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            foreach ($csvData as $row => $data) {
                if (count($data) == 9) {
                    $res = $this->getCsvData($data);
                    $setup->getConnection()->insertOnDuplicate(
                        $tableName, $res,
                        [
                            'question',
                            'answer',
                            'question_date',
                            'answer_date',
                            'product_url',
                            'name',
                            'email',
                            'phone',
                            'status',
                            'store_id',
                            'sku',
                            'product_name',
                            'product_id',
                        ]
                    );
                }
            }
        }
    }

    /**
     * @param $fileName
     * @return string
     */
    private function getPathToCsvMagentoAtdec($fileName)
    {
        return $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, 'BodenkoVV_AskQuestion') .
            DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * @param $data
     * @return array
     */
    private function getCsvData($data)
    {
        return [
            'question' => $data[0],
            'answer' => $data[1],
            'question_date' => $data[2],
            'answer_date' => $data[3],
            'product_url' => $data[4],
            'name' => $data[5],
            'email' => $data[6],
            'phone' => $data[7],
            'status' => $data[8],
            'store_id' => $data[9],
            'sku' => $data[10],
            'product_name' => $data[11],
            'product_id' => $data[12],
        ];
    }
}
