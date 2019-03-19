<?php
namespace PalashAs\AskQuestion\Observer\Catalog\Block\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Registry;

/**
 * Class View
 * @package PalashAs\AskQuestion\Observer\Catalog\Block\Product
 */
class View implements \Magento\Framework\Event\ObserverInterface
{
    /** Product Ask Question Custom Layout Name */
    const LAYOUT_HANDLE_NAME = 'catalog_product_view_askquestiontab';

    /** @var Registry */
    protected $_registry;

    /**
     * View constructor.
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->_registry = $registry;
    }

    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $actionName = $event->getData('full_action_name');
        $product = $this->_registry->registry('current_product');
        if ($product && $actionName === 'catalog_product_view' && $product->getAllowToAskQuestions()) {
            $layout = $event->getData('layout');
            $layoutUpdate = $layout->getUpdate();
            $layoutUpdate->addHandle(static::LAYOUT_HANDLE_NAME);
        }
        return $this;
    }
}
