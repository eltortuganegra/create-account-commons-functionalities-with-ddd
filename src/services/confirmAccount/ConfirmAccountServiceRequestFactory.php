<?php

namespace cacf\services\confirmAccount;

use cacf\services\ServiceRequest;

class ConfirmAccountServiceRequestFactory
{
    public function create(string $confirmAccountCode): ServiceRequest
    {
        return new ConfirmAccountServiceRequest($confirmAccountCode);
    }

}