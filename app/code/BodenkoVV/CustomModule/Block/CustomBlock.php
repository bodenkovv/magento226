<?php
namespace BodenkoVV\CustomModule\Block;

/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 19:27
 */

use Magento\Framework\Controller\ResultFactory;
class CustomBlock extends \Magento\Framework\View\Element\Template
{
    //   const HOMEWORK_TEMPLATE = "BodenkoVV_CustomModule::customblock.phtml";
    //   const HOMEWORK_TEMPLATE = "BodenkoVV_CustomModule::myhomework.phtml";
    //   const MYURL = "homework/jsonresponse";
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    public $myurl="home-work/jsonresponse";

    public function myurltext($linktext)
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $linkform="0";
        if (strlen($linktext)>0)
        {
            $linkform="<a href=".$this->getUrl($this->myurl)."> ".$linktext."</a>";
        }

        return $linkform;
    }
}
