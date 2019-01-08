<?php

namespace BodenkoVV\HomeWork10\Ui\DataProvider\Product\Form\Modifier;

use Magento\Bundle\Test\Block\Catalog\Product\View\Type\Option\Checkbox;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Customer\Model\Metadata\Form\Multiselect;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\MultiSelect as MultiSelectt;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\DataType\Boolean as Booleann;
use Magento\Ui\Component\Form\Element\DataType\Date;
use Magento\Ui\Component\Form\Element\Radio;
use Zend\Filter\Boolean;
use \BodenkoVV\HomeWork10\Helper\Data;

class NewField extends AbstractModifier
{
    private $locator;
    protected $_helperData;

    public function __construct(
        Data $helperData,
        LocatorInterface $locator
    ) {
        $this->locator = $locator;
        $this->_helperData = $helperData;
    }
    public function modifyData(array $data)
    {
        return $data;
    }
    public function modifyMeta(array $meta)
    {
        if ($this->_helperData->getGeneralConfig('homework10_askquestion_enable'))
        {
            $meta = array_replace_recursive(
                $meta,
                [
                    'custom_fieldset' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'label' => __('HomeWork10'),
                                    'componentType' => Fieldset::NAME,
                                    'dataScope' => 'data.product.custom_fieldset_homework10',
                                    'collapsible' => true,
                                    'sortOrder' => 1,
                                ],
                            ],
                        ],
                        'children' => [
                            'custom_field_select' => $this->getCustomField('Select TEXT',Select::NAME, 'custom_field_select'),
                            'custom_field_selects' => $this->getCustomField('Select TEXTs',Multiselectt::NAME, 'custom_field_selects'),
                            'custom_field_input' => $this->getCustomField('Input text',Input::NAME, 'custom_field_input'),
                            'custom_field_date' => $this->getCustomField('Select Date',Date::NAME, 'custom_field_date')
                        ],
                    ]
                ]
            );
        };

        return $meta;
    }

    public function getCustomField($lable, $type, $scope)
    {
       $result=
           [
               'arguments' => [
                   'data' => [
                       'config' => [
                           'label' => __($lable),
                           'componentType' => Field::NAME,
                           'dataScope' => $scope,
                           'sortOrder' => 1,
                       ],
                   ],
               ],
           ];
        if ($type==Select::NAME) {
            $result['arguments']['data']['config']['options'] = [
                                                                    ['value' => '0', 'label' => __('value 0')],
                                                                    ['value' => '1', 'label' => __('value 1')],
                                                                    ['value' => '2', 'label' => __('value 2')],
                                                                    ['value' => '3', 'label' => __('value 3')],
                                                                    ['value' => '4', 'label' => __('value 3')]
                                                                ];
            $result['arguments']['data']['config']['formElement'] = $type;
            $result['arguments']['data']['config']['dataType'] = Text::NAME;

        }elseif ($type==Input::NAME){
            $result['arguments']['data']['config']['formElement'] = $type;
            $result['arguments']['data']['config']['dataType'] = Text::NAME;
        }elseif ($type==Date::NAME){
            $result['arguments']['data']['config']['formElement'] = $type;
            $result['arguments']['data']['config']['dataType'] = $type;
        }elseif ($type==Multiselectt::NAME){
            $result['arguments']['data']['config']['options'] = [
                                                                    ['value' => '0', 'label' => __('value 0')],
                                                                    ['value' => '1', 'label' => __('value 1')],
                                                                    ['value' => '2', 'label' => __('value 2')],
                                                                    ['value' => '3', 'label' => __('value 3')],
                                                                    ['value' => '4', 'label' => __('value 3')]
                                                                ];
            $result['arguments']['data']['config']['formElement'] = $type;
            $result['arguments']['data']['config']['dataType'] = Text::NAME;
        }

        return $result;
    }
}
