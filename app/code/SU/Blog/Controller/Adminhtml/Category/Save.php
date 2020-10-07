<?php

namespace SU\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use SU\Blog\Model\CategoryFactory;

class Save extends Action
{
    protected $categoryFactory;

    public function __construct(Action\Context $context, CategoryFactory $categoryFactory)
    {
        parent::__construct($context);
        $this->categoryFactory = $categoryFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $id = !empty($data['entity_id']) ? $data['entity_id'] : null;
        $newData = [
            'name' => $data['name'],
            'url_key' => $data['url_key'],
            'status' => $data['status'],
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : 0,
        ];
        $category = $this->categoryFactory->create();

        if ($id) {
            $category->load($id);
            $this->getMessageManager()->addSuccessMessage(__('You add the category.'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('You saved the category.'));
        }
        try {
            $category->addData($newData);
            $category->save();
            if ($category->getParentId() == 0) {
                $path = $category->getId();
            } else {
                $path = $category->getParentId() . '/' . $category->getId();
            }
            $category->setData("path", $path);
            $category->save();
            return $this->_redirect('blog/category/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('You false the category.'));
        }
    }
}
