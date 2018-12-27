<?php

namespace cacf\services\resetPassword;


class ResetPasswordServiceRequestFactory
{
    public function create(string $recoveryPassword, string $password)
    {
        return new ResetPasswordServiceRequest($recoveryPassword, $password);
    }

}