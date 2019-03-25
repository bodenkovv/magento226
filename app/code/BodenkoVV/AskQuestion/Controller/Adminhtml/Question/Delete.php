<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BodenkoVV\AskQuestion\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;

/**
 * Class Delete
 * @package BodenkoVV\AskQuestion\Controller\Adminhtml\Question
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'BodenkoVV_AskQuestion::question_delete';

    /** @var \BodenkoVV\AskQuestion\Model\Question  */
    public $questionModel;

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
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            $title = "";
            try {
                $model = $this->questionModel;
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                $this->messageManager->addSuccessMessage(__('The page has been deleted.'));
                $this->_eventManager->dispatch('adminhtml_question_on_delete', [
                    'title' => $title,
                    'status' => 'success'
                ]);
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_question_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
