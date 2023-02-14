<?php

namespace Actecnology\ModuloBasico\Block;

use Magento\Framework\View\Element\Template;

class Actecnology extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,  //para inyeccion de dependencias
        array $data = []
    ){
        parent::__construct($context, $data);
        
    }
}
