<?php


namespace Actecnology\ModuloBasico\Model\ResourceModel;


class Subscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('actecnology_subscription', 'subscription_id'); //la tabla de la DB, identificador de la tabla
    }
}