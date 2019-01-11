<?php
 namespace BodenkoVV\AskQuestion\Controller\Submit;

 use Magento\Framework\App\Request\Http;
 use Magento\Framework\Controller\ResultFactory;
 use Magento\Framework\Exception\LocalizedException;
 use BodenkoVV\AskQuestion\Model\Question;

 class Index extends \Magento\Framework\App\Action\Action
 {
     const STATUS_ERROR = 'Error';
     const STATUS_SUCCESS = 'Success';

     /**
      * @var \Magento\Framework\Data\Form\FormKey\Validator
      */
     private $formKeyValidator;

     /**
      * @var \BodenkoVV\AskQuestion\Model\QuestionFactory
      */
     private $requestQuestionFactory;

     /**
      * Index constructor.
      * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
      * @param \Magento\Framework\App\Action\Context $context
      */
     public function __construct(
         \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
         BodenkoVV\AskQuestion\Model\QuestionFactory $requestQuestionFactory,
         \Magento\Framework\App\Action\Context $context
     ) {
         parent::__construct($context);
         $this->requestQuestionFactory = $requestQuestionFactory;
         $this->formKeyValidator = $formKeyValidator;
     }

     /**
      * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
      * @throws \Exception
      */
     public function execute()
     {
         /** @var Http $request */
         $request = $this->getRequest();

         try {
             if (!$this->formKeyValidator->validate($request) || $request->getParam('hideit')) {
                 throw new LocalizedException(__('Something went wrong. Probably you were away for quite a long time already. Please, reload the page and try again.!!!'));
             }

             if (!$request->isAjax()) {
                 throw new LocalizedException(__('This date is not valid and can not be commit.'));
             }

             if (strpos(trim($request->getParam('phone')),'+380')===false)
             {
                 throw new LocalizedException(__('Not valid Ukrainian Phone Number.'));
             }


             /** @var ResultFactory $requestQuestion */
             $requestQuestion = $this->requestQuestionFactory->create();
             $requestQuestion->setName($request->getParam('name'))
                 ->setEmail($request->getParam('email'))
                 ->setPhone($request->getParam('phone'))
                 ->setProductName($request->getParam('product_name'))
                 ->setSku($request->getParam('sku'))
                 ->setRequest($request->getParam('question'));
             $requestQuestion->save();

             $data = [
                 'status' => self::STATUS_SUCCESS,
                 'message' => __('Your Question receive.')
             ];
         } catch (LocalizedException $e) {
             $data = [
                 'status'  => self::STATUS_ERROR,
                 'message' => $e->getMessage()
             ];
         }



 /**
          * @var \Magento\Framework\Controller\Result\Json $controllerResult
          */
         $controllerResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
         return $controllerResult->setData($data);
     }
 }
