<?php

namespace cacf\models\user;


use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\password\Password;

class UserFactory
{
    public function create(
        Identifier $identifier,
        Email $email,
        Password $password,
        AccountConfirmationCode $accountConfirmationCode): User
    {
        return new UserImplementation($identifier, $email, $password, $accountConfirmationCode);
    }

}