<?php


namespace cacf\services\resetPassword;


use cacf\services\ServiceRequest;

class ResetPasswordServiceRequest implements ServiceRequest
{
    private $recoveryPasswordCode;
    private $password;

    public function __construct(string $recoveryPasswordCode, string $password)
    {
        $this->recoveryPasswordCode = $recoveryPasswordCode;
        $this->password = $password;
    }

    public function getRecoveryPasswordCode(): string
    {
        return $this->recoveryPasswordCode;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}