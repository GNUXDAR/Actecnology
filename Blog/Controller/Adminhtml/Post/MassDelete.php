<?php


namespace Actecnology\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Actecnology\Blog\Model\ResourceModel\Post\CollectionFactory;
use Actecnology\Blog\Model\Post;

class MassDelete extends Action
{
    private $filter;
    private $collectionFactory;
    private $postRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Post $postRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;

            foreach ($collection as $model) {
                $this->postRepository->deleteById($model->getId());
                $count++;
            }
            
            $this->messageManager->addSuccessMessage(__('Un total de %1 Blog(s) se han eliminado.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actecnology_Blog::delete');
    }
}
