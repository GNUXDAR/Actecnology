<?php

namespace Actecnology\SaleSku\Block\Adminhtml\DailyReport;

use Magento\Backend\Block\Template;

class Index extends Template
{
    protected $dailySalesReportFactory;

    public function __construct(
        Template\Context $context,
        \Actecnology\SaleSku\Model\DailySalesReportFactory $dailySalesReportFactory,
        array $data = []
    ) {
        $this->dailySalesReportFactory = $dailySalesReportFactory;
        parent::__construct($context, $data);
    }

    public function getSalesData()
    {
        $dailySalesReport = $this->dailySalesReportFactory->create();
        return $dailySalesReport->getSalesData();
    }
}
