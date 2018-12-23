<?php

namespace cacf\models\accountConfirmationCode;

class AccountConfirmationCodeImplementation implements AccountConfirmationCode
{
    private $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

}