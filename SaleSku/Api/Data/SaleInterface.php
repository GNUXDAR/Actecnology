<?php

namespace Actecnology\SaleSku\Api\Data;

interface SaleInterface
{
    /**
     * Get sale ID.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get SKU.
     *
     * @return string|null
     */
    public function getSku();

    /**
     * Get offer ID.
     *
     * @return int|null
     */
    public function getOfferId();

    /**
     * Get order ID.
     *
     * @return int|null
     */
    public function getOrderId();

    /**
     * Get sale quantity.
     *
     * @return int|null
     */
    public function getQuantity();
}
