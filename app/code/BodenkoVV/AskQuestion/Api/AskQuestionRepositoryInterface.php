<?php


namespace BodenkoVV\AskQuestion\Api;


use Magento\Framework\Api\SearchCriteriaInterface;
use BodenkoVV\AskQuestion\Api\Data\AskQuestionInterface;

/**
 * Ask Question CRUD interface.
 * @api
 */
interface AskQuestionRepositoryInterface
{
    /**
     * Save ask question.
     *
     * @param AskQuestionInterface $askQuestion
     * @return AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(AskQuestionInterface $askQuestion);
    /**
     * Retrieve ask question.
     *
     * @param int $askQuestionId
     * @return AskQuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($askQuestionId);
    /**
     * Retrieve ask question matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \BodenkoVV\AskQuestion\Api\Data\AskQuestionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
    /**
     * Delete ask question.
     *
     * @param AskQuestionInterface $askQuestion
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(AskQuestionInterface $askQuestion);
    /**
     * Delete ask question by ID.
     *
     * @param int $askQuestionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($askQuestionId);

}