<?php

namespace Actecnology\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Actecnology\Blog\Model\PostFactory;

class Post extends Action
{
    protected $postFactory;

    public function __construct(Context $context, PostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // {url}/actecnolgy_blog/index/post/
        $post = $this->postFactory->create();

        $post->setTitle('AC Tecnology');
        $post->setContent('Soluciones Informaticas.');

        $post->save();
        $this->getResponse()->setBody('Yes Success');
    }
}
