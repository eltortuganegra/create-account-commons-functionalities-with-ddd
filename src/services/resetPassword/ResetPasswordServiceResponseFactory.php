<?php


namespace cacf\services\resetPassword;


use cacf\services\ServiceResponse;

class ResetPasswordServiceResponseFactory
{
    public function create(bool $wasPasswordReset): ServiceResponse
    {
        return new ResetPasswordServiceResponse($wasPasswordReset);
    }

}