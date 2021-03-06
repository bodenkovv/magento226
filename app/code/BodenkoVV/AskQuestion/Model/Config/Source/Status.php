<?php

namespace BodenkoVV\AskQuestion\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * @api
 * @since 100.0.2
 */
class Status implements ArrayInterface
{
    /**
     * Options Status question
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('PROCESSED'),
                'value' => 'processed',
            ],
            [
                'label' => __('PENDING'),
                'value' => 'pending',
            ],
            [
                'label' => __('SUCCESS'),
                'value' => 'success',
            ],
            [
                'label' => __('MISSED'),
                'value' => 'missed',
            ],
            [
                'label' => __('ERROR'),
                'value' => 'error',
            ],
            [
                'label' => __('ANSWERED'),
                'value' => 'answered',
            ]
        ];
    }
}