<?php

namespace Actecnology\SaleSku\Service;

use Actecnology\SaleSku\Model\SaleFactory;
use Actecnology\SaleSku\Model\DailySalesReportFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;

class DailySalesReportService
{
    protected $saleFactory;
    protected $dailySalesReportFactory;
    protected $dateTime;

    public function __construct(
        SaleFactory $saleFactory,
        DailySalesReportFactory $dailySalesReportFactory,
        DateTime $dateTime
    ) {
        $this->saleFactory = $saleFactory;
        $this->dailySalesReportFactory = $dailySalesReportFactory;
        $this->dateTime = $dateTime;
    }

    public function generateDailySalesReport()
    {
        $date = $this->dateTime->gmtDate('Y-m-d');

        // Obtener las ventas del día
        $sales = $this->saleFactory->create()->getCollection();
        $sales->addFieldToFilter('created_at', ['gteq' => $date . ' 00:00:00'])
              ->addFieldToFilter('created_at', ['lteq' => $date . ' 23:59:59']);

        // Generar el informe diario y almacenarlo en la tabla
        $reportData = [];
        foreach ($sales as $sale) {
            $sku = $sale->getSku();
            if (!isset($reportData[$sku])) {
                $reportData[$sku] = [
                    'sku' => $sku,
                    'total_sales' => 0,
                ];
            }
            $reportData[$sku]['total_sales'] += $sale->getQuantity();
        }

        // Guardar el informe diario en la tabla
        foreach ($reportData as $data) {
            $dailySalesReport = $this->dailySalesReportFactory->create();
            $dailySalesReport->setDate($date);
            $dailySalesReport->setSku($data['sku']);
            $dailySalesReport->setTotalSales($data['total_sales']);
            $dailySalesReport->save();
        }
    }
}
