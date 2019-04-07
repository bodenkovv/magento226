<?php

namespace BodenkoVV\AskQuestion\Cron;

use BodenkoVV\AskQuestion\Helper\Data;
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

    /** @var BodenkoVV\AskQuestion\Model\Config\Source\Status */
    public $cronStatusAlert;

    /**
     * ChangeStatusOnCron constructor.
     * @param LoggerInterfaceAlias $logger
     * @param CollectionFactory $askQuestionsFactory
     */
    public function __construct(
        LoggerInterfaceAlias $logger,
        Data $helperData,
        CollectionFactory $askQuestionsFactory
    )
    {
        $this->logger = $logger;
        $this->helperData = $helperData;
        $this->questionsFactory = $askQuestionsFactory;
    }

    public function execute()
    {

        if ($this->helperData->getGeneralConfig('bodenkovv_askquestion_enable_auto_confirming')) {

            $this->cronDayAlert = $this->helperData->getGeneralConfig('bodenkovv_askquestion_frequency_auto');
            $this->cronStatusAlert = $this->helperData->getGeneralConfig('bodenkovv_askquestion_status_auto');

            $this->cronDayAlert = (($this->cronDayAlert)&&is_numeric($this->cronDayAlert)&&($this->cronDayAlert>0)) ? $this->cronDayAlert : 3;
            $this->cronStatusAlert = (($this->cronStatusAlert)&&($this->cronDayAlert<>Question::STATUS_ANSWERED)) ? $this->cronDayAlert : Question::STATUS_PENDING;

            $currentDate = date("Y-m-d h:i:s");
            $filterDateTime = strtotime('-' . $this->cronDayAlert . ' day', strtotime($currentDate));
            $filterDate = date('Y-m-d h:i:s', $filterDateTime);

            $questions = $this->questionsFactory->create();
            $collection = $questions
                ->addFieldToFilter('status', array('eq' => $this->cronStatusAlert))
                ->addFieldToFilter('question_date', array('lt' => $filterDate));
            foreach ($collection as $item) {
                $item->setStatus(Question::STATUS_ANSWERED)
                    ->setAnswer($item->getAnswer().'; Auto generation. To late more '.$this->cronDayAlert.' day after recive this question.')
                    ->setAnswerDate($currentDate)
                    ->save();
            }
        }
    }
}
