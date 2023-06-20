<?php

namespace Actecnology\SaleSku\Service;

use Actecnology\SaleSku\Api\SaleSkuServiceInterface;
use Actecnology\SaleSku\Api\Data\SaleInterface;
use Actecnology\SaleSku\Api\Data\SaleInterfaceFactory;

use Actecnology\SaleSku\Model\SaleFactory;
use Actecnology\SaleSku\Model\DailySalesReportFactory;

use Actecnology\SaleSku\Model\Sale; //test

class SaleSkuService implements SaleSkuServiceInterface
{
    protected $saleInterfaceFactory;
    protected $saleModel;

    protected $saleFactory;
    protected $dailySalesReportFactory;

    public function __construct(
        SaleInterfaceFactory $saleInterfaceFactory,
        Sale $saleModel,
        SaleFactory $saleFactory,
        DailySalesReportFactory $dailySalesReportFactory
    ) {
        $this->saleInterfaceFactory = $saleInterfaceFactory;
        $this->saleModel = $saleModel;
        $this->saleFactory = $saleFactory;
        $this->dailySalesReportFactory = $dailySalesReportFactory;
    }

    public function registerSale($sku, $offerId, $orderId, $quantity)
    {
        $sale = $this->saleFactory->create();
        $sale->setSku($sku);
        $sale->setOfferId($offerId);
        $sale->setOrderId($orderId);
        $sale->setQuantity($quantity);
        $sale->save();

        return $sale;
    }

    public function getSalesBySku($sku)
    {
        $sales = [];

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
        $sales = [];

        return $sales;
    }

    // - - -

    public function getSKUs()
    {
        // obtener los SKUs únicos que se han vendidos
        $sales = $this->saleFactory->create()->getCollection();
        $sales->getSelect()->reset(\Zend_Db_Select::COLUMNS)->columns('DISTINCT(sku)');

        $skus = [];
        foreach ($sales as $sale) {
            $skus[] = $sale->getSku();
        }

        return $skus;
    }

    public function getSalesBySkuAndDate($sku, $date)
    {
        // Obtener las ventas por SKU y fecha que se creo
        $sales = $this->saleFactory->create()->getCollection();
        $sales->addFieldToFilter('sku', $sku);
        $sales->addFieldToFilter('created_at', ['like' => $date . '%']);

        return $sales;
    }

    public function saveDailySalesReport($date, $sku, $totalSales)
    {
        // Guardar la información en el informe diario de ventas
        $dailySalesReport = $this->dailySalesReportFactory->create();
        $dailySalesReport->setDate($date);
        $dailySalesReport->setSku($sku);
        $dailySalesReport->setTotalSales($totalSales);
        $dailySalesReport->save();
    }
}
