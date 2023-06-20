<?php

namespace Actecnology\SaleSku\Model;

use Magento\Framework\Model\AbstractModel;
use Actecnology\SaleSku\Model\ResourceModel\DailySalesReport\CollectionFactory as DailySalesReportCollectionFactory;
use Magento\Framework\StoreManagerInterface;


class DailySalesReportFactory extends AbstractModel
{
    protected $dailySalesReportCollectionFactory;
    protected $storeManager;

    public function __construct(
        DailySalesReportCollectionFactory $dailySalesReportCollectionFactory,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->dailySalesReportCollectionFactory = $dailySalesReportCollectionFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $registry, $extensionFactory, $storeManager=NULL, $resource, $resourceCollection, $data);
    }

    public function create()
    {
        return $this->dailySalesReportCollectionFactory->create();
    }
}
