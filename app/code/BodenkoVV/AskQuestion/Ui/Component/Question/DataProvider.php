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
     * Data Provider name
     *
     * @var string
     */
    protected $name;

    /**
     * Data Provider Primary Identifier name
     *
     * @var string
     */
    protected $primaryFieldName;

    /**
     * Data Provider Request Parameter Identifier name
     *
     * @var string
     */
    protected $requestFieldName;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * Provider configuration data
     *
     * @var array
     */
    protected $data = [];

    /**
     * DataProvider constructor.
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $questionCollectionFactory
     * @param array $data
     */
    public function __construct(
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct(

            $primaryFieldName,
            $requestFieldName,
            $data[]);
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
