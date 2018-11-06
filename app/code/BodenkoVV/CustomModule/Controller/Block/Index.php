<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */
namespace BodenkoVV\CustomModule\Controller\Block;

use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    public function execute()
    {
        $homeworkText = "_Home-work 3 - Block _";
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.result')->setGeethubText($geethubText);
        $resultPage->getLayout()->getBlock('custom.lesson.page.myurltext')->setHomeworkText($homeworkText);

        return $resultPage;
    }
}
