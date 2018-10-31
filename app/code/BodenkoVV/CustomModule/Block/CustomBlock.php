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

    /*
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate(self::HOMEWORK_TEMPLATE);

        return $this;
    }
*/

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    public $myurl="99999";

    public function myurltext($myurl)
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */

        //$resultPage = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
        //$resultPage ->$block->getUrl('homework/JsonResponse');
        //$block->getUrl('homework/JsonResponse');

        //$myurl=$resultPage ->$block->getUrl('homework/JsonResponse');
        //$myurl=getUrl($myurl);

        //$resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.myurltext')->setMyUrlText($myurl);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.myurltext')->getUrl($myurl);
        //$myurl=getUrl('homework/JsonResponse');
        //return $resultPage;
        //return $myurl;
        return $this->getUrl($myurl);

    }

}

