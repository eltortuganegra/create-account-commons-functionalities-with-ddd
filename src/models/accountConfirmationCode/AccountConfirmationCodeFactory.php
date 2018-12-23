<?php

namespace cacf\models\accountConfirmationCode;

use Ramsey\Uuid\Uuid;

class AccountConfirmationCodeFactory
{
    public function create(string $code): AccountConfirmationCode
    {
        return new AccountConfirmationCodeImplementation($code);
    }

    public function random(): AccountConfirmationCode
    {
        $randomCode = Uuid::uuid4();

        return $this->create($randomCode);
    }
}