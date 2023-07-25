<?php

namespace Actecnology\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

use Psr\Log\LoggerInterface;


class Add extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Agregar Nuevo Registro'));
        return $resultPage;
    }
}
