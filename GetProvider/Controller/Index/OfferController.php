<?php

namespace Actecnology\GetProvider\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class OfferController extends Action
{
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // die("hola");
        $sku = $this->getRequest()->getParam('sku');

        // Aquí realiza la llamada a la API del proveedor utilizando la librería cURL

        // Llamada a la API utilizando cURL
        $providerUrl = 'http://127.0.0.1:8000/';
        $apiUrl = $providerUrl . '/getAllSkuOffers/' . $sku;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        // Procesa la respuesta de la API y prepara los datos para ser devueltos

        $result = $this->resultJsonFactory->create();
        return $result->setData(['response' => $response]);
    }
}
