<?php

namespace SU\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Edit Post"));
        return $resultPage;
    }
}
