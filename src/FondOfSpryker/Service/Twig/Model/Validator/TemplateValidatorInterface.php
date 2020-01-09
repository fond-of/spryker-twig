<?php

namespace FondOfSpryker\Service\Twig\Model\Validator;

interface TemplateValidatorInterface
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
