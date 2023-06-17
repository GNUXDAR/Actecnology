<?php

namespace Actecnology\GetProvider\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\HTTP\Client\Curl;

class Index extends Action
{
    protected $request;
    protected $resultJsonFactory;
    protected $curl;
    protected $connection;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        Curl $curl,
        RequestInterface $request,
        ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->curl = $curl;
        $this->request = $request;
        $this->connection = $resourceConnection->getConnection();
    }

    public function execute()
    {
        $providerHost = 'http://127.0.0.1:8000'; // URL base del proveedor
        $sku = $this->request->getParam('sku'); // Obtén el valor del parámetro SKU de la URL

        $apiUrl = $providerHost . '/getAllSkuOffers/' . $sku; // Construyendo la URL de la API

        $this->curl->get($apiUrl); // Realiza la solicitud GET a la API

        $response = $this->curl->getBody(); // la respuesta de la API

        // Determinar la mejor oferta
        $offers = json_decode($response, true)['offers'];
        $bestOffer = $this->determineBestOffer($offers);

        // Registrar la venta
        $this->registerSale($sku, $bestOffer);

        // Generar reporte diario
        $this->generateDailyReport();

        $result = $this->resultJsonFactory->create();
        return $result->setData(['response' => $response, 'bestOffer' => $bestOffer]);
    }

    private function determineBestOffer($offers)
    {
        $bestOffer = null;

        foreach ($offers as $offer) {
            // Compara el precio de la oferta con el precio de la mejor oferta actual
            if ($bestOffer === null || $offer['price'] < $bestOffer['price']) {
                // Verifica si la oferta tiene disponibilidad de stock
                if ($offer['stock'] > 0) {
                    $bestOffer = $offer;
                }
            } elseif ($offer['price'] == $bestOffer['price']) {
                // Si el precio es igual, compara la calificación del vendedor
                if ($offer['seller']['qualification'] > $bestOffer['seller']['qualification']) {
                    // Verifica si la oferta tiene disponibilidad de stock
                    if ($offer['stock'] > 0) {
                        $bestOffer = $offer;
                    }
                }
            }
        }
        // En este código de ejemplo, se recorre el arreglo de ofertas y se compara el precio de cada oferta 
        // con el precio de la mejor oferta actual. Si la oferta actual tiene un precio más bajo 
        // y tiene disponibilidad de stock, se establece como la nueva mejor oferta. 
        // Si el precio es igual, se compara la calificación del vendedor y se establece la oferta 
        // con la calificación más alta como la nueva mejor oferta, siempre y cuando también tenga disponibilidad de stock.

        return $bestOffer;
    }

    private function registerSale($sku, $offer)
    {
        $tableName = $this->connection->getTableName('sales'); // Nombre de la tabla de ventas

        // Inserta los datos de la venta en la tabla
        $this->connection->insert($tableName, [
            'sku' => $sku,
            'offer_id' => $offer['id'],
            'price' => $offer['price'],
            'sale_date' => date('Y-m-d H:i:s')
        ]);
    }

    private function generateDailyReport()
    {
        $tableName = $this->connection->getTableName('daily_report'); // Nombre de la tabla de informe diario

        // Obtiene las ventas del día por SKU y las suma
        $select = $this->connection->select()
            ->from(['s' => $tableName], ['sku', 'SUM(price) as total_sales'])
            ->where('s.sale_date >= ?', date('Y-m-d 00:00:00'))
            ->group('s.sku');

        $reportData = $this->connection->fetchAll($select);

        // Inserta los datos del informe diario en la tabla
        foreach ($reportData as $data) {
            $this->connection->insert($tableName, [
                'sku' => $data['sku'],
                'total_sales' => $data['total_sales'],
                'report_date' => date('Y-m-d'),
            ]);
        }
    }
}