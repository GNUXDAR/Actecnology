<?php

namespace Actecnology\ModuloBasico\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    protected $resulPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resulPageFactory
    ){
        $this->resulPageFactory = $resulPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     * 
     * @return $this
    */
    public function execute()
    {
        $resultPage = $this->resulPageFactory->create();
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed("Actecnology_ModuloBasico::index");
    }

}