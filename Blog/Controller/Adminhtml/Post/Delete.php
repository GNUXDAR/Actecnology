<?php


namespace Actecnology\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Actecnology\Blog\Model\Post;
use Actecnology\Blog\Model\PostFactory;

class Delete extends Action
{
    protected $postFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actecnology_Blog::post_delete');
    }


    public function execute()
    {
        $id = $this->getRequest()->getParam('post_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->postFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Registro eliminado con éxito'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('El Rregistro no existe'));
        return $resultRedirect->setPath('*/*/');
    }
}
