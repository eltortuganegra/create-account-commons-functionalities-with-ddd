<?php

namespace cacf\services\signUp;

use cacf\services\ServiceRequest;

class SignUpServiceRequest implements ServiceRequest
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}