<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BodenkoVV\AskQuestion\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context as ContextAlias;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Stdlib\DateTime\DateTime;
use BodenkoVV\AskQuestion\Model\QuestionFactory;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class MassDisable
 */
class MassDisable extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'BodenkoVV_AskQuestion::save';

    /** @var Filter */
    protected $filter;

    /** @var CollectionFactory */
    protected $_collectionFactory;

    /** @var QuestionFactory  */
    public $_questionFactory;

    /** @var Date $date */
    protected $date;

    /**
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param ContextAlias $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param DateTime $date
     * @param QuestionFactory $questionFactory
     */
    public function __construct(
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        ContextAlias $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        DateTime $date,
        QuestionFactory $questionFactory
    )
    {
        $this->filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->_questionFactory = $questionFactory;
        $this->date = $date;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getDatetimeNow()
    {
        return $this->date->gmtDate();
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->_collectionFactory->create());
        $model = $this->_questionFactory->create();

        foreach ($collection as $item) {
            $item['status']='pending';
            $item['answer_date']=$this->getDatetimeNow();
            $model->setData($item->getData());
        }
        $model->save();

        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been Pending.', $collection->getSize())
        );

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
