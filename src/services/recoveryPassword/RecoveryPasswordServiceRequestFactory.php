<?php

namespace cacf\services\recoveryPassword;

use cacf\services\ServiceRequest;

class RecoveryPasswordServiceRequestFactory
{
    public function create(string $recoveryEmailAddress, string $recoveryPasswordCode, string $fromEmail, string $subject, string $body): ServiceRequest
    {
        return new RecoveryPasswordServiceRequest($recoveryEmailAddress, $recoveryPasswordCode, $fromEmail, $subject, $body);
    }
}