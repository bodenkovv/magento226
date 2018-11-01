<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */
namespace BodenkoVV\CustomModule\Controller\JsonResponse;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    public function execute()
    {
        $myjsonText = ['variable'=> 'value','variable4'=> 'value','variable3'=> 'value','variable2'=> 'value','variables'=>['variable4'=> 'value','variable3'=> 'value','variable2'=> 'value']];
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_JSON);
 	    $resultPage->setData($myjsonText);

        return $resultPage;
    }
}
