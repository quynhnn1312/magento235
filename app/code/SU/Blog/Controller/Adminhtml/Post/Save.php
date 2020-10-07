<?php

namespace SU\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use SU\Blog\Model\CategoryPostFactory;
use SU\Blog\Model\PostFactory;
use SU\Blog\Model\ProductPostFactory;

class Save extends Action
{
    protected $postFactory;
    protected $productPostFactory;
    protected $categoryPostFactory;

    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        ProductPostFactory $productPostFactory,
        CategoryPostFactory $categoryPostFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->productPostFactory = $productPostFactory;
        $this->categoryPostFactory = $categoryPostFactory;
    }

    public function execute()
    {
        $post = $this->postFactory->create();

        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['id']) ? $data['id'] : null;
        $imageName = !empty($data['thumbnail']) ? $data['thumbnail'][0]['name'] : "default-thumbnail.jpg";

        $newData = [
            'title' => $data['title'],
            'url_key' => $data['url_key'],
            'status' => $data['status'],
            'description' => $data['description'],
            'short_description' => $data['short_description'],
            'publish_date_from' => $data['publish_date_from'],
            'publish_date_to' => $data['publish_date_to'],
            'thumbnail' => $imageName
        ];

        if ($id) {
            $post->load($id);
            $this->getMessageManager()->addSuccessMessage(__('You add the post.'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('You saved the post.'));
        }
        try {
            $post->addData($newData);
            $post->save();
            $postId = $post->getId();

            $this->saveRelatedProduct($data, $id, $postId);
            $this->saveCategoryPost($data, $id, $postId);

            return $this->_redirect('blog/post/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('You false the post.'));
        }
    }

    public function saveRelatedProduct($data, $idPost, $postSaveLastId)
    {
        $productPost = $this->productPostFactory->create();

        if ($idPost) {
            $productPostCollection= $productPost->getCollection();

            foreach ($productPostCollection as $item) {
                if ($idPost == $item['blog_id']) {
                    $productPost->load($idPost, 'blog_id');
                    $productPost->delete();
                }
            }
        }

        $productPost = $this->productPostFactory->create();
        $dataRelatedProduct = isset($data['data']['links']['product']) ? $data['data']['links']['product'] : null;

        if (isset($dataRelatedProduct)) {
            foreach ($dataRelatedProduct as $product) {
                $productPost->setData("product_id", $product['id']);
                $productPost->setData("blog_id", $postSaveLastId);
                $productPost->save();
                $productPost->setData("id", null);
            }
        }
    }

    public function saveCategoryPost($data, $idPost, $postSaveLastId)
    {
        $categoryPost = $this->categoryPostFactory->create();

        if ($idPost) {
            $categoryPostCollection= $categoryPost->getCollection();

            foreach ($categoryPostCollection as $item) {
                if ($idPost == $item['post_id']) {
                    $categoryPost->load($idPost, 'post_id');
                    $categoryPost->delete();
                }
            }
        }

        $categoryPost = $this->categoryPostFactory->create();
        $categories = isset($data['categories']) ? $data['categories'] : null;

        if (isset($categories)) {
            foreach ($categories as $category) {
                $categoryPost->setData("category_id", $category);
                $categoryPost->setData("post_id", $postSaveLastId);
                $categoryPost->save();
                $categoryPost->setData("id", null);
            }
        }
    }
}
