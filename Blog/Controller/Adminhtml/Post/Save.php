<?php


namespace Actecnology\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Actecnology\Blog\Model\Post;


class Save extends Action
{

    protected $uiSaveModel;
    protected $adminsession;

    public function __construct(
        Action\Context $context,
        Post $uiSaveModel,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->uiSaveModel = $uiSaveModel;
        $this->adminsession = $adminsession;
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $post_id = $this->getRequest()->getParam('post_id');
            if ($post_id) {
                $this->uiSaveModel->load($post_id);
            }
            $this->uiSaveModel->setData($data);
            try {
                $this->uiSaveModel->save();
                $this->messageManager->addSuccess(__(''));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->uiSaveModel->getPostId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Se produjo un error al guardar los datos.'));
            }
            $this->_getSession()->setFormData($data);
            
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
