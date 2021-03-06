<?php

namespace BodenkoVV\AskQuestion\Model;

use BodenkoVV\AskQuestion\Helper\Data;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\Product;

/**
 * Class Question
 * @package BodenkoVV\Question\Model
 *
 * @method int|string getRequestId()
 * @method int|string getName()
 * @method Question setName(string $name)
 * @method string getEmail()
 * @method Question setEmail(string $email)
 * @method string getPhone()
 * @method Question setPhone(string $phone)
 * @method string getProductName()
 * @method Question setProductName(string $productName)
 * @method string getSku()
 * @method Question setSku(string $sku)
 * @method string getRequest()
 * @method Question setRequest(string $request)
 * @method string getCreatedAt()
 * @method string getStatus()
 * @method Question setStatus(string $status)
 * @method int|string getStoreId()
 * @method Question setStoreId(int $storeId)
 */
class Question extends AbstractModel
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_ANSWERED = 'answered';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'askquestion_question_model_load_before';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'object';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * Question constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param QuestionResource $resourceModelQuestion
     * @param Magento\Catalog\Model\Product $product
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,

        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * @return AbstractModel
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSave()
    {
        if (!$this->getStatus()) {
            $this->setStatus(self::STATUS_PENDING);
        }

        if (!$this->getStoreId()) {
            $this->setStoreId($this->storeManager->getStore()->getId());
        }

        return parent::beforeSave();
    }
}
