<?php
namespace Actecnology\ModuloBasico\Model\ResourceModel\Subscription;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Actecnology\ModuloBasico\Model\Subscription', 'Actecnology\ModuloBasico\Model\ResourceModel\Subscription'); //clase del Model, clase del resourceModel
    }
}