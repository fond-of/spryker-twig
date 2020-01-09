<?php

namespace FondOfSpryker\Service\Twig;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfSpryker\Service\Twig\TwigServiceFactory getFactory()
 */
class TwigService extends AbstractService implements TwigServiceInterface
{
    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInYves(string $templatePath): bool
    {
        return $this->getFactory()->createTemplateValidator()->isTemplateAvailableInYves($templatePath);
    }

    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInZed(string $templatePath): bool
    {
        return $this->getFactory()->createTemplateValidator()->isTemplateAvailableInZed($templatePath);
    }
}
