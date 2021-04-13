<?php

namespace FondOfSpryker\Zed\Twig\Business;

use FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Twig\Business\TwigBusinessFactory as SprykerTwigBusinessFactory;

/**
 * @method \Spryker\Zed\Twig\TwigConfig getConfig()
 */
class TwigBusinessFactory extends SprykerTwigBusinessFactory
{
    /**
     * @return \Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilderInterface
     */
    protected function createTemplatePathMapBuilderForZed()
    {
        $baseTemplatePathMapBuilderForZed = parent::createTemplatePathMapBuilderForZed();

        return new TemplatePathMapBuilder($baseTemplatePathMapBuilderForZed, $this->getCurrentStore());
    }

    /**
     * @return \Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilderInterface
     */
    protected function createTemplatePathMapBuilderForYves()
    {
        $baseTemplatePathMapBuilderForYves= parent::createTemplatePathMapBuilderForYves();

        return new TemplatePathMapBuilder($baseTemplatePathMapBuilderForYves, $this->getCurrentStore());
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getCurrentStore(): Store
    {
        return Store::getInstance();
    }
}
