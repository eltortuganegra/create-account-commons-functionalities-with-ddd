<?php

namespace cacf\services\signUp;

use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class SignUpService implements Service
{
    private $signUpServiceResponseFactory;

    public function __construct()
    {
        $this->signUpServiceResponseFactory = new SignUpServiceResponseFactory();
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {

        return $this->signUpServiceResponseFactory->create();
    }

}