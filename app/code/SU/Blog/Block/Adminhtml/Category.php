<?php

namespace SU\Blog\Block\Adminhtml;

/**
 * Admin blog category
 */
class Category extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'SU_Blog';
        $this->_headerText = __('Category');
        $this->_addButtonLabel = __('Add New Category');
        parent::_construct();
        if (!$this->_authorization->isAllowed("SU_Blog::category_save")) {
            $this->removeButton('add');
        }
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/add');
    }
}
