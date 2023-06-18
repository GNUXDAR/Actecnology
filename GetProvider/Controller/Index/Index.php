<?php

namespace Actecnology\GetProvider\Controller\Index;

// use \Magento\Framework\App\Action\Action;
// use \Magento\Framework\App\Action\Context;
// use \Magento\Framework\View\Result\PageFactory;
// use Magento\Framework\Controller\Result\JsonFactory;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    
    protected $resulPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resulPageFactory
    ) {
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
