<?php

namespace BodenkoVV\AskQuestion\Model\ResourceModel;

/**
 * Class Question
 * @package BodenkoVV\AskQuestion\Model\ResourceModel
 */
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('bodenkovv_askquestion', 'id');
    }
}
