<?php


namespace BodenkoVV\AskQuestion\Block;

use BodenkoVV\AskQuestion\Model\ResourceModel\Question\Collection;

class Requests
{
    /**
     * @var \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory
     */
    private $collectionFactory;

    /**
     * Requests constructor.
     * @param \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory $collectionFactory
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSampleRequests(): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter()
            ->getSelect()
            ->orderRand();
        if ($limit = $this->getData('limit')) {
            $collection->setPageSize($limit);
        }
        return $collection;
    }

}