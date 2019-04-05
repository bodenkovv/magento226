<?php

namespace BodenkoVV\AskQuestion\Model;

use BodenkoVV\AskQuestion\Helper\Data;
use BodenkoVV\AskQuestion\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\Product;
use BodenkoVV\AskQuestion\Api\Data\AskQuestionInterface;

/**
 * Class Question
 * @package BodenkoVV\Question\Model
 *
 */
class Question extends AbstractModel implements AskQuestionInterface
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

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData('question_id');
    }
    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData('question_id', $id);
    }
    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getData('name');
    }
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }
    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getData('email');
    }
    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        return $this->setData('email', $email);
    }
    /**
     * {@inheritdoc}
     */
    public function getPhone()
    {
        return $this->getData('phone');
    }
    /**
     * {@inheritdoc}
     */
    public function setPhone($phone)
    {
        return $this->setData('phone', $phone);
    }
    /**
     * {@inheritdoc}
     */
    public function getProductName()
    {
        return $this->getData('product_name');
    }
    /**
     * {@inheritdoc}
     */
    public function setProductName($productName)
    {
        return $this->setData('product_name', $productName);
    }
    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->getData('sku');
    }
    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        return $this->setData('sku', $sku);
    }
    /**
     * {@inheritdoc}
     */
    public function getQuestion()
    {
        return $this->getData('question');
    }
    /**
     * {@inheritdoc}
     */
    public function setQuestion($question)
    {
        return $this->setData('question', $question);
    }
    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->getData('status');
    }
    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }
    /**
     * {@inheritdoc}
     */
    public function getStoreId()
    {
        return $this->getData('store_id');
    }
    /**
     * {@inheritdoc}
     */
    public function setStoreId($storeId)
    {
        return $this->setData('store_id', $storeId);
    }

}
