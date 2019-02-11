<?php

namespace BodenkoVV\AskQuestion\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix;//= 'askquestion_question_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject;// = '';

    /**
     * @inheritdoc
     */
    protected function construct()
    {
        $this->_init(
            \BodenkoVV\AskQuestion\Model\Question::class,
            \BodenkoVV\AskQuestion\Model\ResourceModel\Question::class
        );
        $i=0;
//        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Mageplaza'));
//        $this->_eventManager->dispatch('askquestion_question_collection_load_before', ['mp_text' => $textDisplay]);
//        $this->_eventManager->dispatch('askquestion_question_collection_load_before', ['collection' => $this]);
//        $this->_eventManager->dispatch('askquestion_question_model_load_before', ['collection' => $this]);
    }

    /**
     * Redeclare before load method for adding event
     *
     * @return $this
     */
    protected function _beforeLoad()
    {
        $i=0;
        parent::_beforeLoad();
//        $this->_eventManager->dispatch('core_collection_abstract_load_before', ['collection' => $this]);
//        if ($this->_eventPrefix && $this->_eventObject) {
//            $this->_eventManager->dispatch($this->_eventPrefix . '_load_before', [$this->_eventObject => $this]);
//        }
        return $this;
    }

    /**
     * @param int $storeId
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function addStoreFilter(int $storeId = 0): self
    {
        $i=0;
//        if (!$storeId) {
//            $storeId = (int) $this->storeManager->getStore()->getId();
//        }
//        $this->addFieldToFilter('store_id', $storeId);
//        return $this;
    }
}
