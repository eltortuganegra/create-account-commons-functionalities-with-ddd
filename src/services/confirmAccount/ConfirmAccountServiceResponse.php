<?php

namespace cacf\services\confirmAccount;

use cacf\services\ServiceResponse;

class ConfirmAccountServiceResponse implements ServiceResponse
{
    private $isAccountConfirmed;


    public function __construct(bool $isAccountConfirmed)
    {
        $this->isAccountConfirmed = $isAccountConfirmed;
    }

    public function getIsAccountConfirmed()
    {
        return $this->isAccountConfirmed;
    }

}