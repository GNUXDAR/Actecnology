<?php

namespace Actecnology\SaleSku\Cron;

use Actecnology\SaleSku\Service\DailySalesReportService;

// use Magento\Framework\App\ObjectManager;


class GenerateDailySalesReport
{
    protected $dailySalesReportService;

    public function __construct(DailySalesReportService $dailySalesReportService)
    {
        $this->dailySalesReportService = $dailySalesReportService;
    }

    public function execute()
    {
        $this->dailySalesReportService->generateDailySalesReport();
    }
}
