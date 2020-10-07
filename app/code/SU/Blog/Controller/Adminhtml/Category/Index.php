<?php

namespace SU\Blog\Controller\Adminhtml\Category;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("All Category"));
        return $resultPage;
    }
}
