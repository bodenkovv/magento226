<?php


namespace BodenkoVV\AskQuestion\Api\Data;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for ask question search results.
 * @api
 */
interface AskQuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get ask question list.
     *
     * @return \BodenkoVV\AskQuestion\Api\Data\AskQuestionInterface[]
     */
    public function getItems();
    /**
     * Set ask question list.
     *
     * @param \BodenkoVV\AskQuestion\Api\Data\AskQuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
