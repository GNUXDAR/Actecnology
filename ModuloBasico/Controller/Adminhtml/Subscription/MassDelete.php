<?php


namespace Actecnology\ModuloBasico\Controller\Adminhtml\Subscription;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Actecnology\ModuloBasico\Model\ResourceModel\Subscription\CollectionFactory;

class MassDelete extends Action
{
    public $collectionFactory;
    public $filter;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ){
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try{
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach($collection as $model){
                $deleteItem = $this->_objectManager->get('Actecnology\ModuloBasico\Model\Subscription')->load($model->getId());
                $deleteItem->delete();
                $count++;
            }
            $this->messageManager->addSuccessMessage(__('Un total de %1 Subscription(s) se han eliminado.', $count));
        }catch(\Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actecnology_ModuloBasico::delete');
    }
}