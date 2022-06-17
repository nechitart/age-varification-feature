<?php

namespace Lachestry\AgeVerification\Api;

use Lachestry\AgeVerification\Api\Data\ValidationResponseInterface;

interface ValidationInterface
{
    /**
     * @param string[] $blocks
     * @return ValidationResponseInterface
     */
    public function validate(array $blocks): ?ValidationResponseInterface;
}
