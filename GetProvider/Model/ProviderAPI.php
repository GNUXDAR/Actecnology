<?php

namespace Actecnology\GetProvider\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
class ProviderAPI
{
    protected $curl;

    public function __construct(
        Curl $curl
    ) {
        $this->curl = $curl;
    }

    public function getAllSkuOffers($sku)
    {
        $apiUrl = 'http://127.0.0.1:8000/getAllSkuOffers/' . $sku;

        // llamda a ala API
        $this->curl->get($apiUrl);
        $response = $this->curl->getBody();

        // Procesa la respuesta de la API y devuelve los datos en el formato adecuado
        $offers = $this->processResponse($response);
        // echo "<pre>";
        // var_dump($offers);
        // echo "</pre>";
        // die("aqui");
        return $offers;
    }

    // Mejor Oferta
    public function getBestOffer($sku)
    {
        // Obtener las ofertas del proveedor utilizando la instancia de ProviderAPI
        $offers = $this->getAllSkuOffers($sku);

        // Aplicar tu criterio de selección para determinar la mejor oferta
        $bestOffer = $this->selectBestOffer($offers);

        // Devolver la información de la mejor oferta
        return $bestOffer;
    }

    private function selectBestOffer($offers)
    {
        // Seleccionar la oferta con el precio más bajo
        $bestOffer = null;
        $lowestPrice = PHP_INT_MAX;

        foreach ($offers as $offer) {
            if ($offer['price'] < $lowestPrice) {
                $bestOffer = $offer;
                $lowestPrice = $offer['price'];
            }
        }

        return $bestOffer;
    }

    private function processResponse($response)
    {
        $responseData = json_decode($response, true);

        if ($responseData && isset($responseData['offers'])) {
            $offers = $responseData['offers'];

            // Procesamiento adicional de los datos de las ofertas
            foreach ($offers as &$offer) {
                // Convertir el precio a formato decimal con dos decimales
                $offer['price'] = number_format($offer['price'], 2);

                // Calcular el precio total sumando el precio y el costo de envío
                $offer['total_price'] = $offer['price'] + $offer['shipping_price'];

                // Verificar si la oferta puede ser devuelta y establecer un mensaje apropiado
                if ($offer['can_be_refunded']) {
                    $offer['refund_message'] = 'Esta oferta es elegible para devolución.';
                } else {
                    $offer['refund_message'] = 'Esta oferta no es elegible para devolución.';
                }
            }

            // Retorna los datos de las ofertas procesados
            return $offers;
        }

        return [];
    }


}
