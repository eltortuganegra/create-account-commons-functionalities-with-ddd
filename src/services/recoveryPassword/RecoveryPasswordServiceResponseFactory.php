<?php

namespace cacf\services\recoveryPassword;


use cacf\services\ServiceResponse;

class RecoveryPasswordServiceResponseFactory
{
    public function create(bool $isRecoveryPasswordSent): ServiceResponse
    {
        return new RecoveryPasswordServiceResponse($isRecoveryPasswordSent);
    }

}