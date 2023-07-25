<?php

namespace Actecnology\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class Post extends AbstractDb
{
    public function _construct()
    {
        $this->_init('actecnology_blog_post', 'post_id');
    }
}
