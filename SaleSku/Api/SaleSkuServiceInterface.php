<?php

namespace Actecnology\SaleSku\Api;

interface SaleSkuServiceInterface
{
    /**
     * Register a sale for a SKU and offer.
     *
     * @param string $sku
     * @param int $offerId
     * @param int $orderId
     * @return \Actecnology\SaleSku\Api\Data\SaleInterface
     */
    public function registerSale($sku, $offerId, $orderId);

    /**
     * Get sales for a specific SKU.
     *
     * @param string $sku
     * @return \Actecnology\SaleSku\Api\Data\SaleInterface[]
     */
    public function getSalesBySku($sku);

    /**
     * Get all sales information.
     *
     * @return \Actecnology\SaleSku\Api\Data\SaleInterface[]
     */
    public function getSalesInformation();
}
