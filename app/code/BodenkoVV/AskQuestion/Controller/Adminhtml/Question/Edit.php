<?php

namespace BodenkoVV\AskQuestion\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;

/**
 * Class Edit
 * @package BodenkoVV\AskQuestion\Controller\Adminhtml\Question
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'BodenkoVV_AskQuestion::save';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /** @var string $_pageName */
    protected $_pageName='Question Edit Item';

    /** @var \BodenkoVV\AskQuestion\Model\Question  */
    public $questionModel;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \BodenkoVV\AskQuestion\Model\Question $question
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \BodenkoVV\AskQuestion\Model\Question $question,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionModel = $question;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }


    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->questionModel;
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('bodenkovv_askquestion', $model);
        $resultPage = $this->resultPageFactory->create();

        if (is_numeric($id)&&($id>0)) {
            $resultPage->addBreadcrumb(__('Edit Page'),__('Edit Page'));
            $resultPage->getConfig()->getTitle()
                ->prepend($model->getTitle());
        } else {
            $resultPage->addBreadcrumb(__('New Page'),__('New Page'));
            $resultPage->getConfig()->getTitle()
                ->prepend(__('New Page'));
        }

        return $resultPage;
    }
}
