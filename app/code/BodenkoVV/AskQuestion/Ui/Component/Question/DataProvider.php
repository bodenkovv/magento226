<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BodenkoVV\AskQuestion\Ui\Component\Question;

use \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class DataProvider
 * @package BodenkoVV\AskQuestion\Ui\Component\Question
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /** @var \BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection $collection */
    protected $collection;

    /** @var $loadedData */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
   {
       if (isset($this->loadedData)) {
           return $this->loadedData;
       }
       $items = $this->collection->getItems();
       foreach ($items as $item) {
           $this->loadedData[$item->getId()] = $item->getData();
       }

       return $this->loadedData;
   }
}
