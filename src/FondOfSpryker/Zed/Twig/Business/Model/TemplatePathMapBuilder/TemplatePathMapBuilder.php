<?php

namespace FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder;

use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder as SprykerTemplatePathMapBuilder;

class TemplatePathMapBuilder extends SprykerTemplatePathMapBuilder
{
    /**
     * @return array
     */
    public function build()
    {
        $templatePathMap = parent::build();

        $activeStore = Store::getInstance()->getStoreName();
        foreach ($templatePathMap as $key => $item) {
            if (strpos($key, $activeStore)) {
                $find = str_replace($activeStore, '', $key);
                if (array_key_exists($find, $templatePathMap)){
                    $templatePathMap[$find] = $item;
                    unset($templatePathMap[$key]);
                }
            }
        }
        
        return $templatePathMap;
    }
}
