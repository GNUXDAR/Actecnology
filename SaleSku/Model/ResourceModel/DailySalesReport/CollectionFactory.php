<?php

namespace Actecnology\SaleSku\Model\ResourceModel\DailySalesReport;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class CollectionFactory extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollectionFactory
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Actecnology\SaleSku\Model\DailySalesReport', 'Actecnology\SaleSku\Model\ResourceModel\DailySalesReport');
    }
}
