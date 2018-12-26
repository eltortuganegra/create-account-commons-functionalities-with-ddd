<?php

namespace cacf\services\recoveryPassword;


use cacf\services\ServiceResponse;

class RecoveryPasswordServiceResponse implements ServiceResponse
{
    private $isRecoveryPasswordEmailSent;

    public function __construct(bool $isRecoveryPasswordEmailSent)
    {
        $this->isRecoveryPasswordEmailSent = $isRecoveryPasswordEmailSent;
    }

    public function isRecoveryPasswordEmailNotificationSent(): bool
    {
        return $this->isRecoveryPasswordEmailSent;
    }

}