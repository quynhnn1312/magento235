<?php

namespace SU\Blog\Controller\Adminhtml\Post\Upload;

use SU\Blog\Controller\Adminhtml\Upload\Image\Action;

/**
 * Blog featured image upload controller
 */
class featuredImg extends Action
{
    /**
     * File key
     *
     * @var string
     */
    protected $_fileKey = 'thumbnail';

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SU_Blog::post_save');
    }
}
