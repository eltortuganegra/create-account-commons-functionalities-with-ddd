<?php

namespace cacf\services\signUp;

use cacf\services\ServiceRequest;

class SignUpServiceRequestFactory
{
    public function create(string $email, string $password): ServiceRequest
    {
        return new SignUpServiceRequest($email, $password);
    }

}