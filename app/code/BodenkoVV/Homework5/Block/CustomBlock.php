<?php
namespace BodenkoVV\Homework5\Block;

class CustomBlock extends \Magento\Customer\Block\Form\Register
{
    public $CountryHtmlSelect, $ShowAddressFields = true;

    public function getShowAddressFields()
    {
        return true;
    }

}
