<?php
namespace BodenkoVV\CustomModule\Block;

use Magento\Framework\Controller\ResultFactory;
class CustomBlock extends \Magento\Framework\View\Element\Template
{
    //   const HOMEWORK_TEMPLATE = "BodenkoVV_CustomModule::customblock.phtml";
    //   const HOMEWORK_TEMPLATE = "BodenkoVV_CustomModule::myhomework.phtml";
    //   const MYURL = "homework/jsonresponse";
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    private $myUrl="home-work/jsonresponse";

    public function getLinkForText($linkText)
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $linkForm="0";
        if (strlen($linkText)>0)
        {
            $linkForm="<a href=".$this->getUrl($this->myUrl).">".$linkText."</a>";
        }

        return $linkForm;
    }
}
