<?php

namespace cacf\services\confirmAccount;

use cacf\services\ServiceResponse;

class ConfirmAccountServiceResponseFactory
{
    public function create(bool $isAccountConfirmed): ServiceResponse
    {
        return new ConfirmAccountServiceResponse($isAccountConfirmed);
    }
}