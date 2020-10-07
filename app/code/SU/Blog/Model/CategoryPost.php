<?php

namespace SU\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class CategoryPost extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('SU\Blog\Model\ResourceModel\CategoryPost');
    }
}
