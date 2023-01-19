<?php

namespace Actecnology\ModuloBasico\Block;

use Magento\Framework\View\Element\Template;

class Actecnology extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ){
        parent::__construct($context, $data);
        
    }

}
