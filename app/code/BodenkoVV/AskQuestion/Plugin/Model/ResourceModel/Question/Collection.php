<?php

namespace BodenkoVV\AskQuestion\Plugin\Model\ResourceModel\Question;

use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection as QuestionCollection;
use \BodenkoVV\AskQuestion\Helper\Data;

class Collection
{

//    public function beforeLoad($identifier, $field = null)
//    {
//        $i=0;
//        $this->addFieldToFilter('store_id', $storeId);
//        $this->_beforeLoad($identifier, $field);
//    }

//public function beforeLoad(\BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory $subject, $storeId)

    //public function beforeAddStoreFilter(QuestionCollectionFactory $questionCollectionFactory, Data $helper)

    //Data $helperData,QuestionCollectionFactory $questionCollection
    public function afterAddStoreFilter(QuestionCollection $subject, $result)
    {

        // logging to test override
//        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
//        $logger->debug('Model Override Test before');
//        $questionCollection=$questionCollection->create();
//        $questionCollection=$questionCollection;

        $product = $result->getCurrentProduct();

        $test1=\Magento\Framework\App\ObjectManager::getInstance()->get('BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory')->create();
        $test2=$result->_postQuestionFactory->create();

//        $this->addFieldToFilter('product_id', ['eq'=>$product->getEntityId()]);
        $result = $subject->addFieldToFilter('product_id', ['eq'=>$product->getEntityId()]);
        $i=0;
       // return $subject->create()->addFieldToFilter('store_id',$storeId);
        return $result;
    }
//
//    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
//    {
//        // logging to test override
//        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
//        $logger->debug('Model Override Test after');
//
//        return $result;
//    }
}

?>
