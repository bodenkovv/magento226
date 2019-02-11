<?php

namespace BodenkoVV\AskQuestion\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Question
 * @package BodenkoVV\AskQuestion\Model\ResourceModel
 */
class Question extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('bodenkovv_askquestion', 'id');
    }
}
