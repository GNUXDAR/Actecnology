<?php

namespace Actecnology\GetProvider\Model;

class ProviderAPI
{
    protected $httpClient;

    public function __construct(
        \Magento\Framework\HTTP\ClientInterface $httpClient
    ) {
        $this->httpClient = $httpClient;
    }

    public function getAllSkuOffers($sku)
    {
        $apiUrl = 'http://127.0.0.1:8000/getAllSkuOffers/' . $sku;
        $this->httpClient->get($apiUrl);

        $response = $this->httpClient->getBody();

        // Procesa la respuesta de la API y devuelve los datos en el formato adecuado
        $offers = $this->processResponse($response);

        return $offers;
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
