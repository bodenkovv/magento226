<?php

namespace BodenkoVV\AskQuestion\Controller\Question;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class Index
 * @package BodenkoVV\AskQuestion\Controller\Question
 */
class Index extends Action
{
    /**
     * Index constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Questions'));
        $this->_view->renderLayout();
    }
}