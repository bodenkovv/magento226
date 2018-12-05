<?php
 namespace BodenkoVV\AskQuestion\Controller\Submit;

 use Magento\Framework\App\Request\Http;
 use Magento\Framework\Controller\ResultFactory;
 use Magento\Framework\Exception\LocalizedException;
 class Index extends \Magento\Framework\App\Action\Action
 {
     const STATUS_ERROR = 'Error';
     const STATUS_SUCCESS = 'Success';
     /**
      * @var \Magento\Framework\Data\Form\FormKey\Validator
      */
     private $formKeyValidator;
     /**
      * Index constructor.
      * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
      * @param \Magento\Framework\App\Action\Context $context
      */
     public function __construct(
         \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
         \Magento\Framework\App\Action\Context $context
     ) {
         parent::__construct($context);
         $this->formKeyValidator = $formKeyValidator;
     }
     /**
      * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
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

             $tempTime=strtotime($request->getParam('hideit2'))-strtotime($request->getParam('hideit1'));
             if (($tempTime==0)or($tempTime>120))
             {
                 if ($request->getParam('phone')[0]=='3')
                 {
                     $data = [
                         'status' => self::STATUS_SUCCESS,
                         'message' => 'Your Question receive.'
                     ];
                 }else
                 {
                     $data = [
                         'status'  => self::STATUS_ERROR,
                         'message' => 'Not valid Ukrainian Phone Number.'
                     ];
                 }
             }else
             {
                 $data = [
                     'status'  => self::STATUS_ERROR,
                     'message' => 'Please waite '.(120-$tempTime).'s and tray again'
                 ];
             }
//             'message' => __('Your request was submitted. We\'ll get in touch with you as soon as possible.')
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
