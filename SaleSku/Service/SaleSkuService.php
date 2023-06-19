<?php

namespace Actecnology\SaleSku\Service;

use Actecnology\SaleSku\Api\SaleSkuServiceInterface;
use Actecnology\SaleSku\Api\Data\SaleInterface;
use Actecnology\SaleSku\Api\Data\SaleInterfaceFactory;

use Actecnology\SaleSku\Model\Sale; //test

class SaleSkuService implements SaleSkuServiceInterface
{
    protected $saleInterfaceFactory;
    protected $saleModel;

    public function __construct(
        SaleInterfaceFactory $saleInterfaceFactory,
        Sale $saleModel
    ) {
        $this->saleInterfaceFactory = $saleInterfaceFactory;
        $this->saleModel = $saleModel;
    }

    public function registerSale($sku, $offerId, $orderId)
    {
        $sale = $this->saleInterfaceFactory->create();
        $sale->setSku($sku);
        $sale->setOfferId($offerId);
        $sale->setOrderId($orderId);
        $sale->save();

        return $sale;
    }

    public function getSalesBySku($sku)
    {
        // Logic to retrieve sales by SKU from your data source
        $sales = []; // Placeholder

        return $sales;
    }

    public function getSalesBySkuAndOrder($sku, $orderId)
    {
        $sales = $this->saleFactory->create()->getCollection();
        $sales->addFieldToFilter('sku', $sku);
        $sales->addFieldToFilter('order_id', $orderId);

        return $sales;
    }


    public function getSalesInformation()
    {
        // Logic to retrieve all sales information from your data source
        $sales = []; // Placeholder

        return $sales;
    }
}
