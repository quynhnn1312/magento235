<?php

namespace SU\Blog\Model\ResourceModel\ProductPost;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = "id";

    protected function _construct()
    {
        $this->_init("SU\Blog\Model\ProductPost", "SU\Blog\Model\ResourceModel\ProductPost");
    }
}
