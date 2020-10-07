<?php

namespace SU\Blog\Model\ResourceModel\CategoryPost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = "id";

    protected function _construct()
    {
        $this->_init("SU\Blog\Model\CategoryPost", "SU\Blog\Model\ResourceModel\CategoryPost");
    }
}
