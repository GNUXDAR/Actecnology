<?php

namespace Actecnology\GetProvider\Block;

use Magento\Framework\View\Element\Template;
use Actecnology\GetProvider\Model\ProviderAPI;

class Offer extends Template
{
    protected $providerAPI;

    public function __construct(
        Template\Context $context,
        ProviderAPI $providerAPI,
        array $data = []
    ) {
        $this->providerAPI = $providerAPI;
        parent::__construct($context, $data);
    }

    public function getBestOffer($sku)
    {
        $offers = $this->providerAPI->getAllSkuOffers($sku);

        // Implementa aquí la lógica para determinar la mejor oferta
        // Puedes utilizar los datos de $offers para comparar precios, disponibilidad, calificaciones, etc.

        // Devuelve la mejor oferta encontrada
        return $bestOffer;
    }
}
