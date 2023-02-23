<?php


namespace Actecnology\ModuloBasico\Controller\Adminhtml\Subscription;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    /**
     * @var \Actecnology\ModuloBasico\Model\Subscription
     */
    protected $modelSubscription;
    /**
     * @param Context $context
     * @param \Actecnology\ModuloBasico\Model\Subscription $subscriptionFactory
     */
    public function __construct(
        Context $context,
        \Actecnology\ModuloBasico\Model\Subscription $subscriptionFactory
    ){
        parent::__construct($context);
        $this->modelSubscription = $subscriptionFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actecnology_ModuloBasico::subscription_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('subscription_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if($id){
            try{
                $model = $this->modelSubscription;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Registro eliminado con éxito'));
                return $resultRedirect->setPath('*/*/');
            }catch(\Exception $e){
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit',['id' => $id]);
            }
        }
        $this->messageManager->addError(__('El Rregistro no existe'));
        return $resultRedirect->setPath('*/*/');
    }
}