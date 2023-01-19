<?php

namespace Actecnology\ModuloBasico\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
    */

    protected $resulPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resulPageFactory
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

}