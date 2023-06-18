<?php

namespace Actecnology\GetProvider\Controller\Index;

// use \Magento\Framework\App\Action\Action;
// use \Magento\Framework\App\Action\Context;
// use \Magento\Framework\View\Result\PageFactory;
// use Magento\Framework\Controller\Result\JsonFactory;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Actecnology\GetProvider\Model\ProviderAPI;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    
    protected $resultPageFactory;
    protected $providerAPI;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ProviderAPI $providerAPI
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->providerAPI = $providerAPI;
        parent::__construct($context);
    }

    /**
     * Index action
     * 
     * @return $this
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        // Obtener los datos de la API
        $sku = '3'; // SKU del producto a consultar
        $offers = $this->providerAPI->getAllSkuOffers($sku);

        // Pasar los datos a la vista
        // var_dump($offers);
        $resultPage->getConfig()->getTitle()->set('Ofertas'); // Establecer el título de la página
        $resultPage->getLayout()->getBlock('actecnology.getprovider.offer')->setData('offers', $offers); // Pasar los datos de las ofertas al bloque de la vista

        return $resultPage;
    }

}
