<?php


namespace cacf\services\login;


use cacf\services\ServiceRequest;

class LoginServiceRequestFactory
{
    public function create(string $emailAddress, string $plainTextPassword): ServiceRequest
    {
        return new LoginServiceRequest($emailAddress, $plainTextPassword);
    }

}