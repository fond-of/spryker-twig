<?php

namespace FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder;

use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilderInterface;

class TemplatePathMapBuilder implements TemplatePathMapBuilderInterface
{
    /**
     * @var \Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilderInterface
     */
    protected $templatePathMapBuilder;

    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @param \Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilderInterface $templatePathMapBuilder
     * @param \Spryker\Shared\Kernel\Store $store
     */
    public function __construct(
        TemplatePathMapBuilderInterface $templatePathMapBuilder,
        Store $store
    ) {
        $this->templatePathMapBuilder = $templatePathMapBuilder;
        $this->store = $store;
    }

    /**
     * @return string[]
     */
    public function build(): array
    {
        $storeName = $this->store->getStoreName();
        $templatePathMap = $this->templatePathMapBuilder->build();

        foreach ($templatePathMap as $key => $item) {
            $newKey = $this->prepareKey($key, $item, $storeName);

            if ($newKey !== $key) {
                $templatePathMap[$newKey] = $item;
                unset($templatePathMap[$key]);
            }
        }

        return $templatePathMap;
    }

    /**
     * @param string $key
     * @param string $item
     * @param string $storeName
     *
     * @return string
     */
    protected function prepareKey(string $key, string $item, string $storeName): string
    {
        $newKey = $key;

        if (preg_match('/Yves\/ShopUi\/Theme\/[a-z]+\/packages\//', $item) === 1) {
            $itemParts = explode('/', $item);
            $packagesPosition = array_search('packages', $itemParts, true);
            $module = $itemParts[$packagesPosition + 2];
            $template = array_slice($itemParts, $packagesPosition + 3);
            $prefix = strpos($key, '@Pyz:') === 0 ? 'Pyz:' : '';
            $newKey = sprintf('@%s%s/%s', $prefix, $module, implode('/', $template));
        }

        if (strpos($newKey, $storeName)) {
            $newKey = str_replace($storeName, '', $newKey);
        }

        return $newKey;
    }
}
