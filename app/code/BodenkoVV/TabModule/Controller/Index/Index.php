<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */
namespace BodenkoVV\TabModule\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */

    public function execute()
    {
        $homeworkText = "_Home-work 4_";
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($resultPage->getLayout()->getBlock('custom.homework4.tab2')){
            $resultPage->getLayout()->getBlock('custom.homework4.tab2')->setHomeworkText($homeworkText);
        }

        if ($resultPage->getLayout()->getBlock('custom.homework4.tab')){
            $resultPage->getLayout()->getBlock('custom.homework4.tab')->setHomeworkText($homeworkText);
        }

        return $resultPage;
    }
}
