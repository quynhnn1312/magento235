<?php

namespace SU\Blog\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use SU\Blog\Model\PostFactory;

class Save extends Action
{
    protected $postFactory;

    public function __construct(Context $context, PostFactory $postFactory)
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $this->postFactory->create();
        $model = $this->postFactory->create();
        $model->setData("title", "abc");
        $model->setData("short_description", "sjkdvnaos");
        $model->setData("description", "sjkdvnaos");
        $model->setData("thumbnail", "sjkdvnaos");
        $model->setData("url_key", "sjkdvnaos");
        $model->save();
        echo "hello";
    }
}
