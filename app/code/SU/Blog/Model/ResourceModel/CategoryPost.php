<?php

namespace SU\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CategoryPost extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sumup_blog_category_post', 'id');
    }
}
