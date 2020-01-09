<?php

namespace FondOfSpryker\Service\Twig;

interface TwigServiceInterface
{
    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInYves(string $templatePath): bool;

    /**
     * @param string $templatePath
     *
     * @return bool
     */
    public function isTemplateAvailableInZed(string $templatePath): bool;
}
