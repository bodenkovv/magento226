<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 29.10.18
 * Time: 10:26
 */

namespace Vector\Module\Block;

class test extends \Magento\Framework\View\Element\Template
{
    public function getWorldTxt()
    {
        return 'Test #1!';
    }

    public function getWorld2Txt()
    {
        return 'Test #2!';
    }
}