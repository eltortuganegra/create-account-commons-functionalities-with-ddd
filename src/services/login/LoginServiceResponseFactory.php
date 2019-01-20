<?php


namespace cacf\services\login;


use cacf\services\ServiceResponse;

class LoginServiceResponseFactory
{
    public function create(bool $areCredentialsValid, string $identifier, string $username): ServiceResponse
    {
        return new LoginServiceResponse($areCredentialsValid, $identifier, $username);
    }

}