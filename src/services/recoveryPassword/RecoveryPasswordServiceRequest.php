<?php

namespace cacf\services\recoveryPassword;


use cacf\services\ServiceRequest;

class RecoveryPasswordServiceRequest implements ServiceRequest
{
    private $recoveryEmailAddress;
    private $fromEmail;
    private $subject;
    private $body;

    public function __construct(string $recoveryEmailAddress, string $fromEmail, string $subject, string $body)
    {
        $this->recoveryEmailAddress = $recoveryEmailAddress;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getRecoveryEmailAddress(): string
    {
        return $this->recoveryEmailAddress;
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