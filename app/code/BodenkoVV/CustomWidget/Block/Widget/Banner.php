<?php
namespace BodenkoVV\CustomWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $_template = 'widget/customwidget.phtml';

    public function getCustomWidgetTitle()
    {
        return __($this->getData('widget_button_title'));
    }

}
