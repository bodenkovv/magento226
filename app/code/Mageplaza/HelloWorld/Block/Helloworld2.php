<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 29.10.18
 * Time: 10:26
 */

namespace Mageplaza\HelloWorld\Block;

class Helloworld2 extends \Magento\Framework\View\Element\Template
{
    public function getHelloWorldTxt()
    {
        return 'Hello my world #1!';
    }

    public function getHelloWorld2Txt()
    {
        return 'Hello my world #2!';
    }
}