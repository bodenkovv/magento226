<?php
namespace BodenkoVV\Homework5\Block;

class CustomBlock extends \Magento\Customer\Block\Form\Register
{
    public $CountryHtmlSelect;
    public $name, $id, $title, $defValue;
    public $_company,$_telephone,$_gender,$_fax,$_streetValidationClass;

    public function getCountryHtmlSelect($defValue=null, $name='country_id', $id='country', $title='Country')
    {
        if ($defValue==null)
        {
            return "Ukraine";
        }
            return $defValue;
    }

    public function getShowAddressFields()
    {
        return "S.Smirnova";
    }

}
