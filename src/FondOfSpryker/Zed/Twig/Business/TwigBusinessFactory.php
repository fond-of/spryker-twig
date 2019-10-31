<?php

namespace FondOfSpryker\Zed\Twig\Business;

use Spryker\Zed\Twig\Business\TwigBusinessFactory as SprykerTwigBusinessFactory;
use FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder;

/**
 * @method \Spryker\Zed\Twig\TwigConfig getConfig()
 */
class TwigBusinessFactory extends SprykerTwigBusinessFactory
{

    /**
     * @return \FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder
     */
    protected function createTemplatePathMapBuilderForZed()
    {
        $templatePathMapBuilder = new TemplatePathMapBuilder(
            $this->createFinder(),
            $this->createTemplateNameBuilderZed(),
            $this->getConfig()->getZedDirectoryPathPatterns()
        );

        return $templatePathMapBuilder;
    }

    /**
     * @return \FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder
     */
    protected function createTemplatePathMapBuilderForYves()
    {
        $templatePathMapBuilder = new TemplatePathMapBuilder(
            $this->createFinder(),
            $this->createTemplateNameBuilderYves(),
            $this->getConfig()->getYvesDirectoryPathPatterns()
        );

        return $templatePathMapBuilder;
    }
}
