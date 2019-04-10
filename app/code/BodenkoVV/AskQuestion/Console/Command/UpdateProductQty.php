<?php

namespace BodenkoVV\AskQuestion\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Magento\Framework\App\Area;

class UpdateProductQty extends \Symfony\Component\Console\Command\Command
{

    /** @var State */
    private $state;

    /** @var StockStateInterface  */
    protected $_stockStateInterface;

    /** @var Magento\CatalogInventory\Api\StockRegistryInterface */
    protected $_stockRegistry;

    /** @var ProductRepositoryInterface  */
    public $productRepository;

    /**
     * CustomQtyUpdate constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param StockStateInterface $stockStateInterface
     * @param StockRegistryInterface $stockRegistry
     * @param State $state
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        StockStateInterface $stockStateInterface,
        StockRegistryInterface $stockRegistry,
        State $state
    )
    {
        $this->productRepository = $productRepository;
        $this->_stockStateInterface = $stockStateInterface;
        $this->_stockRegistry = $stockRegistry;
        $this->state = $state;
        parent::__construct();
    }

    /**
     * @param int $productId
     * @param int $qty
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function updateProductStock($productId, $qty) {
        $product = $this->productRepository->getById($productId);
        $stockItem = $this->_stockRegistry->getStockItem($product->getId());
        $stockItem->setData('manage_stock',1);
        $stockItem->setData('use_config_notify_stock_qty',1);
        $stockItem->setData('is_in_stock',1);
        $stockItem->setData('qty',$qty);

        if ($stockItem->save()) {
            $this->_stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
            return true;
        }

        return false;
    }

    protected function configure()
    {
        $this->setName('update-product:update-product-qty')
            ->setDescription('Update Product Qty')
            ->setDefinition([
                new InputArgument(
                    'product_id',
                    InputArgument::OPTIONAL,
                    'Product Id'
                ),
                new InputArgument(
                    'qty',
                    InputArgument::OPTIONAL,
                    'Product Qty'
                )
            ]);
        parent::configure();
    }

    /**
     * @param $id
     * @return bool
     */
    private function isNumericData($id)
    {
        if (isset($id) && is_numeric($id) && ($id >= 0)) {
            return true;
        }

        return false;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws LocalizedException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        if ($this->isNumericData($input->getArgument('product_id'))) {
            $productId = $input->getArgument('product_id');
        } else {
            $output->writeln("<info>NEED Input product Id (numeric) for update!<info>");
            return;
        }
        if ($this->isNumericData($input->getArgument('qty'))) {
            $qty = $input->getArgument('qty');
        } else {
            $output->writeln("<info>NEED Input product qty (numeric)for update:<info>");
            return;
        }
        $output->writeln("<info>You enter Product Id: $productId and Product Qty: $qty. <info>");

        if ($this->updateProductStock($productId, $qty)) {
            $output->writeln("<info>Product has been updated. <info>");
        } else {
            $output->writeln("<info>Product has not been updated. Some truble....<info>");
        }
    }
}
