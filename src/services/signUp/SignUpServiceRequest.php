<?php

namespace cacf\services\signUp;

use cacf\services\ServiceRequest;

class SignUpServiceRequest implements ServiceRequest
{
    private $email;
    private $password;
    private $fromEmail;
    private $subject;
    private $body;

    public function __construct(
        string $email,
        string $password,
        string $fromEmail,
        string $subject,
        string $body
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

}