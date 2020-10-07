<?php

namespace SU\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('SU\Blog\Model\ResourceModel\Category');
    }
}
