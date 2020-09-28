<?php


namespace BodenkoVV\AskQuestion\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\User\Model\UserFactory;

class ForMail extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var StateInterface
     */
    private $inlineTranslation;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * Mail constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param ScopeConfigInterface $scopeConfig
     * @param UserFactory $userFactory
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        UserFactory $userFactory
    ) {
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->userFactory = $userFactory;
        parent::__construct($context);
    }
    /**
     * @param $emailFrom
     * @param string $customerName
     * @param $message
     * @param $product
     * @param $sku
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function sendMail($emailFrom, $customerName, $message, $product, $sku)
    {
        $templateOptions = [
            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
            'store' => $this->storeManager->getStore()->getId()
        ];
        $templateVars = [
            'store' => $this->storeManager->getStore(),
            'customer_name' => $customerName,
            'message'   => $message,
            'product'  => $product,
            'sku'      => $sku
        ];
        $this->inlineTranslation->suspend();
        /**
         * Email to customers
         */
        $from = ['email' => $this->getAdminEmail(), 'name' => 'Admin'];
        $to = [$emailFrom];
        $transport = $this->transportBuilder->setTemplateIdentifier('askQuestionCustomer')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();
        /**
         * Email to admin
         */
        $from = ['email' => $emailFrom, 'name' => $customerName];
        $to = [$this->getAdminEmail()];
        $transport = $this->transportBuilder->setTemplateIdentifier('askQuestionAdmin')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
    }
    /**
     * @return mixed|string
     */
    private function getAdminEmail()
    {
        $transEmailSaller = $this->scopeConfig->getValue(
            'trans_email/ident_sales/email',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if ($transEmailSaller) {
            return $transEmailSaller;
        }
        return '';
    }
    /**
     * @return mixed
     */
    public function getEnableFlagEmailing()
    {
        return $this->scopeConfig->getValue(
            'ask_question_options/email/emailing',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES
        );
    }
}