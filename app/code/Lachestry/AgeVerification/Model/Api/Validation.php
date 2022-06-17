<?php

namespace Lachestry\AgeVerification\Model\Api;

use Lachestry\AgeVerification\Api\Data\ValidationResponseInterface;
use Lachestry\AgeVerification\Api\ValidationInterface;
use Lachestry\AgeVerification\Model\Config;
use Lachestry\AgeVerification\Model\VerificationBlock\Validation as Validator;
use Lachestry\AgeVerification\Model\ValidationResponseFactory;

class Validation implements ValidationInterface
{
    CONST IS_VALID_RESPONSE_FIELD = 'is_valid';
    CONST ERRORS_RESPONSE_FIELD = 'errors';

    private $validator;
    private $config;
    private $responseFactory;

    public function __construct(
        Validator $validator,
        Config $config,
        ValidationResponseFactory $responseFactory
    ) {
        $this->validator = $validator;
        $this->config = $config;
        $this->responseFactory = $responseFactory;
    }

    public function validate(array $blocks): ?ValidationResponseInterface
    {
        if (!$this->config->getIsEnable()) {
            return null;
        }

        /** @var ValidationResponseInterface $response */
        $response = $this->responseFactory->create();
        $block = implode('-', $blocks);
        $isValid = $this->validator->validate($block);

        $response->setIsValid($isValid);
        if (!$isValid) {
            $response->setErrors($this->validator->getErrorLog());
        }

        return $response;
    }
}
