<?php

namespace cacf\services\signUp;

use cacf\services\ServiceRequest;

class SignUpServiceRequestFactory
{
    public function create(
        string $email,
        string $password,
        string $fromEmail,
        string $subject,
        string $body
    ): ServiceRequest
    {
        return new SignUpServiceRequest($email, $password, $fromEmail, $subject, $body);
    }

}