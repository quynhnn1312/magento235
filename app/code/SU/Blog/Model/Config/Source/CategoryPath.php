<?php

namespace SU\Blog\Model\Config\Source;

class CategoryPath extends CategoryTree
{
    protected function _getOptions($itemId = 0)
    {
        $childs =  $this->_getChilds();
//        var_dump(1);die();

        $options = [];

        if (!$itemId) {
            $options[] = [
                'label' => '',
                'value' => 0,
            ];
        }

        if (isset($childs[$itemId])) {
            foreach ($childs[$itemId] as $item) {
                $data = [
                    'label' => $item->getName() .
                        ($item->getStatus() ? '' : ' (' . __('Disabled') . ')'),
                    'value' => ($item->getParentIds() ? $item->getPath() . '/' : '') . $item->getId(),
                ];
                if (isset($childs[$item->getId()])) {
                    $data['optgroup'] = $this->_getOptions($item->getId());
                }

                $options[] = $data;
            }
        }

        return $options;
    }
}
