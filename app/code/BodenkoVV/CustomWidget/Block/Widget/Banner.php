<?php
namespace BodenkoVV\CustomWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    /** @var string  */
    protected $_template = 'widget/customwidget.phtml';

    /**
     * get value from widget variable
     * @return string
     */
    public function getWidgetButtonTitle()
    {
        return $this->getData('widget_button_title');
    }

    /**
     * get Widget Block
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getWidgetBlock()
    {
        return $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId('Banner-Homepage')->toHtml();
    }
}
