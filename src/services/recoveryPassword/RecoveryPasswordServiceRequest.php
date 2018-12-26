<?php

namespace cacf\services\recoveryPassword;


use cacf\services\ServiceRequest;

class RecoveryPasswordServiceRequest implements ServiceRequest
{
    private $recoveryEmailAddress;
    private $recoveryPasswordCode;
    private $fromEmail;
    private $subject;
    private $body;

    public function __construct(
        string $recoveryEmailAddress,
        string $recoveryPasswordCode,
        string $fromEmail,
        string $subject,
        string $body)
    {
        $this->recoveryEmailAddress = $recoveryEmailAddress;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
        $this->body = $body;
        $this->recoveryPasswordCode = $recoveryPasswordCode;
    }

    public function getRecoveryEmailAddress(): string
    {
        return $this->recoveryEmailAddress;
    }

    public function getRecoveryPasswordCode(): string
    {
        return $this->recoveryPasswordCode;
    }

    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }

}