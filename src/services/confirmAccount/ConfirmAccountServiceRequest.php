<?php

namespace cacf\services\confirmAccount;

use cacf\services\ServiceRequest;

class ConfirmAccountServiceRequest implements ServiceRequest
{
    private $confirmAccountCode;

    public function __construct(string $confirmAccountCode)
    {
        $this->confirmAccountCode = $confirmAccountCode;
    }

    public function getConfirmAccountCode(): string
    {
        return $this->confirmAccountCode;
    }

}