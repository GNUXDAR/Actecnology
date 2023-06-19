<?php

/**
 * Copyright © Arturo Cabrera All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Actecnology\SaleSku\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sale extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('actecnology_sale_sku', 'id');
    }
}
