<?php


namespace Actecnology\ModuloBasico\Controller\Adminhtml\Subscription;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Actecnology\ModuloBasico\Model\Subscription;

class Save extends \Magento\Backend\App\Action
{
    /*
     * @var Subscription
     */
    protected $uiExamplemodel;
    /*
     * @var Session
     */
    protected $adminsession;
    /**
     * @param Action\Context $context
     * @param Subscription $uiExamplemodel
     * @param Session $adminsession
     */
    public function __construct(
        Action\Context $context,
        Subscription $uiExamplemodel,
        Session $adminsession
    ){
        parent::__construct($context);
        $this->uiExamplemodel = $uiExamplemodel;
        $this->adminsession = $adminsession;
    }

    /**
     * Save Subscription record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if( $data ){
            $subscription_id = $this->getRequest()->getParam('subscription_id');
            if( $subscription_id){
                $this->uiExamplemodel->load($subscription_id);
            }
            $this->uiExamplemodel->setData($data);
            try{
                $this->uiExamplemodel->save();
                $this->messageManager->addSuccess(__('El registro se ha guardado'));
                $this->adminsession->setFormData(false);
                if($this->getRequest()->getParam('back')){
                    if($this->getRequest()->getParam('back') == 'add'){
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $this->uiExamplemodel->getSubscriptionId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            }catch(\Magento\Framework\Exception\LocalizedException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\RuntimeException $e){
                $this->messageManager->addError($e->getMessage());
            }catch(\Exception $e){
                $this->messageManager->addException($e, __('Se produjo un error al guardar los datos.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $this->getRequest()->getParam('subscription_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}