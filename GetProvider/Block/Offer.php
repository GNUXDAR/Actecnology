<?php

namespace Actecnology\GetProvider\Block;

use Magento\Framework\View\Element\Template;
use Actecnology\GetProvider\Model\ProviderAPI;

class Offer extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,  //para inyeccion de dependencias
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
