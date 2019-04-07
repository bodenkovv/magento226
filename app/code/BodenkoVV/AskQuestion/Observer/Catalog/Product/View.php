<?php

namespace BodenkoVV\AskQuestion\Observer\Catalog\Block\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Registry;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Group;

class View implements ObserverInterface
{
    /** @var \Magento\Framework\Registry */
    private $registry;

    /** @var Session */
    private $customerSession;

    /** @var Group */
    private $customerGroup;

    /**
     * View constructor.
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Registry $registry,
        Session $customerSession,
        Group $customerGroup
    ) {
        $this->registry = $registry;
        $this->customerSession = $customerSession;
        $this->customerGroup = $customerGroup;
    }

    /**
     * @return string
     */
    protected function getCustomerGroup()
    {
        $currentGroupId = $this->customerSession->getCustomer()->getGroupId();
        $collection = $this->customerGroup->load($currentGroupId);
        return $collection->getCustomerGroupCode();
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $actionName = $observer->getEvent()->getData('full_action_name');
        $product = $this->registry->registry('current_product');
        $layout = $observer->getEvent()->getData('layout');
        if ($product && $actionName === 'catalog_product_view' && !$this->customerSession->getCustomer()->getDisallowAskQuestion() && $this->getCustomerGroup() !== 'Forbidden for Ask Question') {
            $layout->getUpdate()->addHandle('catalog_product_view_ask_question_tab');
        }
        return $this;
    }
}
