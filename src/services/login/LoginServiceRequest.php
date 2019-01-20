<?php

namespace cacf\services\login;


use cacf\services\ServiceRequest;

class LoginServiceRequest implements ServiceRequest
{
    private $emailAddress;
    private $plainTextPassword;

    public function __construct(string $emailAddress, string $plainTextPassword)
    {
        $this->emailAddress = $emailAddress;
        $this->plainTextPassword = $plainTextPassword;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getPlainTextPassword(): string
    {
        return $this->plainTextPassword;
    }

}