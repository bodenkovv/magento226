<?php

namespace BodenkoVV\AskQuestion\Cron;

use BodenkoVV\AskQuestion\Model\Question;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use Psr\Log\LoggerInterface as LoggerInterfaceAlias;

class ChangeStatusOnCron
{
    /** @var CollectionFactory  */
    protected $questionsFactory;

    /** @var LoggerInterfaceAlias */
    private $logger;

    /** @var int  */
    public $cronDayAlert;

    /**
     * ChangeStatusOnCron constructor.
     * @param LoggerInterfaceAlias $logger
     * @param CollectionFactory $askQuestionsFactory
     */
    public function __construct(
        LoggerInterfaceAlias $logger,
        CollectionFactory $askQuestionsFactory
    )
    {
        $this->logger = $logger;
        $this->questionsFactory = $askQuestionsFactory;
        $this->cronDayAlert = 3;
    }
    public function execute()
    {
        $currentDate = date("Y-m-d h:i:s");
        $filterDateTime = strtotime('-' . $this->cronDayAlert . ' day', strtotime($currentDate));
        $filterDate = date('Y-m-d h:i:s', $filterDateTime);

        $questions = $this->questionsFactory->create();
        $collection = $questions->getCollection()
            ->addFieldToFilter('status', array('eq' => Question::STATUS_PENDING))
            ->addFieldToFilter('created_at', array('lt' => $filterDate));
        foreach ($collection as $item) {
            $item->setStatus(Question::STATUS_ANSWERED)->save();
        }
    }
}
