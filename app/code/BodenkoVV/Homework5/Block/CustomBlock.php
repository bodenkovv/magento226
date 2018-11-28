<?php

namespace BodenkoVV\Homework5\Block;

// \Magento\Directory\Block\Data
class CustomBlock extends \Magento\Customer\Block\Form\Register
{
    public $CountryHtmlSelect;
    public $name, $id, $title, $defValue;
    public $_company,$_telephone,$_gender,$_fax,$_streetValidationClass;


    public function getCountryHtmlSelect($defValue=null, $name='country_id', $id='country', $title='Country')
    {
//        $this->$name=$name;
//        $this->$id=$id;
//        $this->$title=$title;
//        $this->$defValue=$defValue;
        if ($defValue==null)
        {
            return "Ukraine";
        }
            return $defValue;
    }

    public function getShowAddressFields()
    {
//        $this->$_company=;
//        $this->$_telephone=;
//        $this->$_gender=;
//        $this->$_fax=;
//        $this->$_streetValidationClass=;

        return "S.Smirnova";
    }

}
