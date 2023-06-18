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

        // Obtener todas las ofertas del proveedor
        $allOffers = $this->providerAPI->getAllOffers($sku);

        // Variables para almacenar la mejor oferta
        $bestOfferPrice = null;
        $bestOffer = null;

        foreach ($allOffers as $offer) {
            // Verificar si la oferta es la mejor hasta el momento
            if ($bestOfferPrice === null || $offer['price'] < $bestOfferPrice) {
                $bestOfferPrice = $offer['price'];
                $bestOffer = $offer;
            }
        }
        // se puede utilizar los datos de $offers para comparar precios, disponibilidad, calificaciones, etc.

        // Devuelve la mejor oferta encontrada
        return $bestOffer;
    }

    }
