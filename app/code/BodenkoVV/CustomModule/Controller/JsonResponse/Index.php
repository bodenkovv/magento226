<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */
namespace BodenkoVV\CustomModule\Controller\JsonResponse;

/*
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
*/

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        //$geethubText = "return json ";
        //$myjsonText = setJsonData('{"variable": "value","variable4": "value","variable3": "value","variable2": "value","variables":"{"variable4": "value","variable3": "value","variable2": "value"}}"}');
        //$myjsonText = "{\"variable\": "value","variable4": "value","variable3": "value","variable2": "value","variables":"{"variable4": "value","variable3": "value","variable2": "value"}}"}';
        $myjsonText = ['variable'=> 'value','variable4'=> 'value','variable3'=> 'value','variable2'=> 'value','variables'=>['variable4'=> 'value','variable3'=> 'value','variable2'=> 'value']];

        /** @var \Magento\Framework\View\Result\Page $resultPage */

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_JSON);

    //    $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.result.jsonresponse')->setGeethubText($geethubText);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.result.jsonresponse')->setMyJsonText($myjsonText);
	    $resultPage->setData($myjsonText);

     //        $resultPage->setData($myjsonText);

        return $resultPage;
    }
}
