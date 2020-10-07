<?php

namespace SU\Blog\Model\Config;

use Magento\Framework\UrlInterface as MagentoUrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use SU\Blog\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    protected $collection;
    protected $storeManager;

    const MEDIA_FOLDER = 'catalog/tmp/category';

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->storeManager = $storeManager;
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $post) {
            $post = $post->load($post->getId()); //temporary fix
            $data = $post->getData();

            /* Prepare Featured Image */
            $map = [
                'thumbnail' => 'getThumbnail',
            ];
            foreach ($map as $key => $method) {
                if (isset($data[$key])) {
                    $name = $data[$key];
                    unset($data[$key]);
                    $data[$key][0] = [
                        'name' => $name,
                        'url' => $this->getMediaUrl($post->$method()),
                        'type' => 'image',
                    ];
                }
            }

            $this->_loadedData[$post->getId()] = $data;
        }
        return $this->_loadedData;
    }

    public function getMediaUrl($image)
    {
        if (!$image) {
            return false;
        }
        $url = $this->storeManager->getStore()
                ->getBaseUrl(MagentoUrlInterface::URL_TYPE_MEDIA) . self::MEDIA_FOLDER;
        $url .= '/' . $image;
        return $url;
    }
}
