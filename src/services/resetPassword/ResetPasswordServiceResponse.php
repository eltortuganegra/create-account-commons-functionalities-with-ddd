<?php

namespace cacf\services\resetPassword;


use cacf\services\ServiceResponse;

class ResetPasswordServiceResponse implements ServiceResponse
{
    private $wasPasswordReset;

    public function __construct(bool $wasPasswordReset)
    {
        $this->wasPasswordReset = $wasPasswordReset;
    }

    public function wasPasswordReset(): bool
    {
        return $this->wasPasswordReset;
    }

}