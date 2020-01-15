<?php

namespace FondOfSpryker\Service\Twig;

use FondOfSpryker\Service\Twig\Model\Validator\TemplateValidator;
use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Shared\Twig\TwigFilesystemLoader;

class TwigServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfSpryker\Service\Twig\Model\Validator\TemplateValidator
     */
    public function createTemplateValidator(): TemplateValidator
    {
        return new TemplateValidator(
            $this->getTwigFilesystemLoaderYves(),
            $this->getTwigFilesystemLoaderZed()
        );
    }

    /**
     * @return \Spryker\Shared\Twig\TwigFilesystemLoader
     */
    protected function getTwigFilesystemLoaderYves(): TwigFilesystemLoader
    {
        return $this->getProvidedDependency(TwigDependencyProvider::TWIG_FILESYSTEMLOADER_YVES);
    }

    /**
     * @return \Spryker\Shared\Twig\TwigFilesystemLoader
     */
    protected function getTwigFilesystemLoaderZed(): TwigFilesystemLoader
    {
        return $this->getProvidedDependency(TwigDependencyProvider::TWIG_FILESYSTEMLOADER_ZED);
    }
}
