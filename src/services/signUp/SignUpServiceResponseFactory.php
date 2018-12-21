<?php

namespace cacf\services\signUp;


use cacf\models\identifier\Identifier;
use cacf\services\ServiceResponse;

class SignUpServiceResponseFactory
{
    public function create(Identifier $identifier, bool $isWelcomeEmailNotificationSent): ServiceResponse
    {
        return new SignUpServiceResponse($identifier, $isWelcomeEmailNotificationSent);
    }

}