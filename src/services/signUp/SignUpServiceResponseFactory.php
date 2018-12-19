<?php

namespace cacf\services\signUp;


use cacf\models\identifier\Identifier;
use cacf\services\ServiceResponse;

class SignUpServiceResponseFactory
{
    public function create(Identifier $identifier): ServiceResponse
    {
        return new SignUpServiceResponse($identifier);
    }

}