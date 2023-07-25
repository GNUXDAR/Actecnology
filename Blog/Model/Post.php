<?php

namespace Actecnology\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

use Actecnology\Blog\Model\ResourceModel\Post as PostResource;

class Post extends AbstractModel
{

    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ){
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct()
    {
        $this->_init(PostResource::class);
    }

    public function deleteById($postId)
    {
        $this->load($postId);
        $this->delete();
    }
}