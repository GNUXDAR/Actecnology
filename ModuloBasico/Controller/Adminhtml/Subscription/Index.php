<?php

namespace Actecnology\ModuloBasico\Controller\Adminhtml\Subscription;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Actecnology_ModuloBasico::subscription');
        $resultPage->addBreadcrumb(__('Grid Subscription'), __('Grid Subscription'));
        $resultPage->addBreadcrumb(__('Manage Subscription'), __('Manage Subscription'));
        $resultPage->getConfig()->getTitle()->prepend(__('Subscriptions'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actecnology_ModuloBasico::subscription');
    }
}