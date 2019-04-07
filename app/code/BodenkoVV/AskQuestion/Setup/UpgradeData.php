<?php

namespace BodenkoVV\AskQuestion\Setup;

use BodenkoVV\AskQuestion\Model\QuestionFactory;
use Exception;
use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Attribute;
use Magento\Customer\Model\Group;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \BodenkoVV\AskQuestion\Model\Question;
use Magento\Framework\Component\ComponentRegistrar;
use \Magento\Framework\File\Csv;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\GroupFactory;
use Magento\Customer\Model\ResourceModel\GroupRepository;
use Magento\Store\Model\Store;

/**
 * Class UpgradeData
 * @package BodenkoVV\AskQuestion\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /** @var Csv */
    private $csv;

    /** @var ComponentRegistrar */
    private $componentRegistrar;

    /**  @var EavSetupFactory */
    private $eavSetupFactory;

    /**  @var Attribute */
    private $customerAttribute;

    /**  @var GroupFactory */
    private $groupFactory;

    /**  @var GroupRepository */
    private $groupRepository;

    /**
     * UpgradeData constructor.
     * @param QuestionFactory $questionFactory
     * @param ComponentRegistrar $componentRegistrar
     * @param Csv $csv
     * @param EavSetupFactory $eavSetupFactory
     * @param Attribute $customerAttribute
     * @param GroupFactory $groupFactory
     * @param GroupRepository $groupRepository
     */
    public function __construct(
        QuestionFactory $questionFactory,
        ComponentRegistrar $componentRegistrar,
        Csv $csv,
        EavSetupFactory $eavSetupFactory,
        Attribute $customerAttribute,
        GroupFactory $groupFactory,
        GroupRepository $groupRepository
    )
    {
        $this->componentRegistrar = $componentRegistrar;
        $this->csv = $csv;
        $this->questionFactory = $questionFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerAttribute = $customerAttribute;
        $this->groupFactory = $groupFactory;
        $this->groupRepository = $groupRepository;
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
            $eavSetup->removeAttribute(Product::ENTITY, 'allow_ask_questions');
            $eavSetup->addAttribute(
                Product::ENTITY,
                'allow_to_ask_questions',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Allow to ask questions',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => Boolean::class,
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
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


        $version='1.0.3';
        $setup->startSetup();

        $setup->startSetup();
        if ($context->getVersion()
            && version_compare($context->getVersion(), $version) < 0
        ) {
            //add attribute
            $code = 'disallow_ask_question';
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                Customer::ENTITY,
                'disallow_ask_question',
                [
                    'type'         => 'int',
                    'label'        => 'Disallow Ask Question',
                    'input'        => 'select',
                    'source'       => Boolean::class,
                    'required'     => false,
                    'visible'      => false,
                    'user_defined' => true,
                    'position'     => 999,
                    'system'       => 0,
                    'default'      => 0,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
                ]
            );
            $attribute = $this->customerAttribute->loadByCode(Customer::ENTITY, $code);
            $attribute->addData([
                'attribute_set_id' => 1,
                'attribute_group_id' => 1,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
            ])->save();


            // add Group
            /** @var Group $group */
            $group = $this->groupFactory->create();
            $group->setCode('Forbidden for Ask Question')->save();


            // add section Corpus
            $code = 'corpus';
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                'customer_address',
                $code,
                [
                    'label'        => 'Corpus',
                    'input'        => 'text',
                    'required'     => false,
                    'visible'      => true,
                    'position'     => 999,
                    'default'      => '-',
                    'system'       => 0
                ]
            );
            $attribute = $this->customerAttribute->loadByCode('customer_address', $code);
            $attribute->addData([
                'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
            ])->save();
        }
        $setup->endSetup();

    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param $fileName
     * @throws Exception
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
