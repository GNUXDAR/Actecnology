<?php

namespace Actecnology\SaleSku\Model;

use Magento\Framework\Model\AbstractModel;
use Actecnology\SaleSku\Api\Data\SaleInterface;
use Actecnology\SaleSku\Model\ResourceModel\Sale as SaleResource;

class Sale extends AbstractModel implements SaleInterface
{
    protected function _construct()
    {
        $this->_init(SaleResource::class);
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    public function getOfferId()
    {
        return $this->getData(self::OFFER_ID);
    }

    public function setOfferId($offerId)
    {
        return $this->setData(self::OFFER_ID, $offerId);
    }

    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    public function getQuantity()
    {
        return $this->getData(self::QUANTITY);
    }

    public function setQuantity($quantity)
    {
        return $this->setData(self::QUANTITY, $quantity);
    }
}
