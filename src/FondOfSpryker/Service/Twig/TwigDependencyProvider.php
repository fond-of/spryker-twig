<?php

namespace FondOfSpryker\Service\Twig;

use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use Spryker\Yves\Kernel\ClassResolver\Factory\FactoryResolver as YvesFactoryResolver;
use Spryker\Yves\Twig\TwigFactory as YvesTwigFactory;
use Spryker\Zed\Kernel\ClassResolver\Factory\FactoryResolver as ZedFactoryResolver;
use Spryker\Zed\Twig\Communication\TwigCommunicationFactory as ZedTwigCommunicationFactory;

class TwigDependencyProvider extends AbstractBundleDependencyProvider
{
    public const TWIG_FILESYSTEMLOADER_ZED = 'TWIG_FILESYSTEMLOADER_ZED';
    public const TWIG_FILESYSTEMLOADER_YVES = 'TWIG_FILESYSTEMLOADER_YVES';

    /**
     * @var \Spryker\Yves\Twig\TwigFactory
     */
    protected $yvesTwigFactory;

    /**
     * @var \Spryker\Zed\Twig\Communication\TwigCommunicationFactory
     */
    protected $zedTwigFactory;

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = parent::provideServiceDependencies($container);

        $container = $this->addTwigEnvironment($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addTwigEnvironment(Container $container): Container
    {
        $container[static::TWIG_FILESYSTEMLOADER_ZED] = function () {
            return $this->getZedTwigFactory()->createFilesystemLoader();
        };

        $container[static::TWIG_FILESYSTEMLOADER_YVES] = function () {
            return $this->getYvesTwigFactory()->createFilesystemLoader();
        };

        return $container;
    }

    /**
     * @return \Spryker\Yves\Twig\TwigFactory
     */
    protected function getYvesTwigFactory(): YvesTwigFactory
    {
        if ($this->yvesTwigFactory === null) {
            $this->yvesTwigFactory = $this->resolveYvesFactory();
        }

        return $this->yvesTwigFactory;
    }

    /**
     * @return \Spryker\Yves\Twig\TwigFactory
     */
    private function resolveYvesFactory(): YvesTwigFactory
    {
        return $this->getYvesFactoryResolver()->resolve(YvesTwigFactory::class);
    }

    /**
     * @return \Spryker\Yves\Kernel\ClassResolver\Factory\FactoryResolver
     */
    private function getYvesFactoryResolver(): YvesFactoryResolver
    {
        return new YvesFactoryResolver();
    }

    /**
     * @return \Spryker\Zed\Twig\Communication\TwigCommunicationFactory
     */
    protected function getZedTwigFactory(): ZedTwigCommunicationFactory
    {
        if ($this->zedTwigFactory === null) {
            $this->zedTwigFactory = $this->resolveZedFactory();
        }

        return $this->zedTwigFactory;
    }

    /**
     * @return \Spryker\Zed\Twig\Communication\TwigCommunicationFactory
     */
    private function resolveZedFactory(): ZedTwigCommunicationFactory
    {
        return $this->getZedFactoryResolver()->resolve(ZedTwigCommunicationFactory::class);
    }

    /**
     * @return \Spryker\Zed\Kernel\ClassResolver\Factory\FactoryResolver
     */
    private function getZedFactoryResolver(): ZedFactoryResolver
    {
        return new ZedFactoryResolver();
    }
}
