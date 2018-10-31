<?php
/**
 * Created by PhpStorm.
 * User: vector
 * Date: 30.10.18
 * Time: 15:42
 */

namespace BodenkoVV\CustomModule\Controller\ShowPerson;

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
        $homenameText = "Victor";
        $lastnameText = "Bodenko";
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()->getBlock('custom.lesson.page.showpersonname')->setHomeNameText($homenameText);
        $resultPage->getLayout()->getBlock('custom.lesson.page.showpersonlastname')->setHomeLastNameText($lastnameText);
/*
        $resultPage->getLayout()
            ->getBlock('custom.lesson.page.result.showperson.name')
            ->setHomenameText($homenameText);
        $resultPage->getLayout()
            ->getBlock('custom.lesson.page.result.showperson.lastname')
            ->setLastnameText($lastnameText);

        $resultPage->getLayout()->getBlock('custom.lesson.page.result.showperson.name')->setData($homenameText);
        $resultPage->getLayout()->getBlock('custom.lesson.page.result.showperson.lastname')->setData($lastnameText);
    */
        return $resultPage;
    }
}
