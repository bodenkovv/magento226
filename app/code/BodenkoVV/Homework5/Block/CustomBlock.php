<?php
namespace BodenkoVV\Homework5\Block;

class CustomBlock extends \Magento\Customer\Block\Form\Register
{
    public $CountryHtmlSelect, $ShowAddressFields = true;
//    public $name, $id, $title, $defValue;
//    public $_company,$_telephone,$_gender,$_fax,$_streetValidationClass;

    public function getShowAddressFields()
    {
        return true;
    }

}
