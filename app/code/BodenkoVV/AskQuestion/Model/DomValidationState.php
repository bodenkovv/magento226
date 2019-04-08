<?php
/**
 * Application config file resolver
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BodenkoVV\AskQuestion\Model;

/**
 * Class DomValidationState
 * @package Magento\Cms\Model\Page
 */
class DomValidationState implements \Magento\Framework\Config\ValidationStateInterface
{
    /**
     * Retrieve validation state
     *
     * @return boolean
     */
    public function isValidationRequired()
    {
        return true;
    }
}
