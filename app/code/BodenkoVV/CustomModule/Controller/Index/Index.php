<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */
namespace BodenkoVV\CustomModule\Controller\Index;

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
        /**
         * $this->_view->loadLayout();
         * $this->_view->renderLayout();
         */
     //
         $geethubText = "Home-work 3";
         $homeworkText = "_Home-work 3_";


        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        //$resultPage->getLayout()->getBlock('custom.lesson.page.result')->setGeethubText($geethubText);
        $resultPage->getLayout()->getBlock('custom.lesson.page.result')->setHomeworkText($homeworkText);
        return $resultPage;
    }
}