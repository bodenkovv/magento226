<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BodenkoVV\AskQuestion\Controller\Adminhtml\Question;

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
                $model = $this->_objectManager->create(\BodenkoVV\AskQuestion\Model\Question::class);
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
