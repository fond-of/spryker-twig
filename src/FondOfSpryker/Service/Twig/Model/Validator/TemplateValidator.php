<?php

namespace FondOfSpryker\Service\Twig\Model\Validator;

use Spryker\Shared\Twig\TwigFilesystemLoader;
use Twig\Error\LoaderError;

class TemplateValidator implements TemplateValidatorInterface
{
    /**
     * @var \Spryker\Shared\Twig\TwigFilesystemLoader
     */
    protected $twigYves;

    /**
     * @var \Spryker\Shared\Twig\TwigFilesystemLoader
     */
    protected $twigZed;

    /**
     * @param \Spryker\Shared\Twig\TwigFilesystemLoader $twigYves
     * @param \Spryker\Shared\Twig\TwigFilesystemLoader $twigZed
     */
    public function __construct(TwigFilesystemLoader $twigYves, TwigFilesystemLoader $twigZed)
    {
        $this->twigYves = $twigYves;
        $this->twigZed = $twigZed;
    }

    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInYves(string $templatePath): bool
    {
        return $this->isTemplateAvailable('yves', $templatePath);
    }

    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInZed(string $templatePath): bool
    {
        return $this->isTemplateAvailable('zed', $templatePath);
    }

    /**
     * @param string $area
     * @param string $templatePath
     *
     * @return bool
     */
    protected function isTemplateAvailable(string $area, string $templatePath): bool
    {
        try {
            $this->{sprintf('twig%s', ucfirst($area))}->getSource($templatePath);
        } catch (LoaderError $loaderError) {
            return false;
        }

        return true;
    }
}
