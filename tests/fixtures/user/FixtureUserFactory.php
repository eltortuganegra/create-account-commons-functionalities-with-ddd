<?php

namespace tests\fixtures\user;

use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\models\email\Email;
use cacf\models\email\EmailFactory;
use cacf\models\identifier\IdentifierFactory;
use cacf\models\password\Password;
use cacf\models\password\PasswordFactory;
use cacf\models\user\User;
use cacf\models\user\UserFactory;

abstract class FixtureUserFactory
{
    const IDENTIFIER = '';
    const EMAIL = '';
    const PASSWORD = '';
    const ACCOUNT_CONFIRMATION_CODE = '';
    const PASSWORD_INVALID = 'Invalid password';

    public function create(): User
    {
        $identifier = $this->createIdentifier();
        $email = $this->createEmail();
        $password = $this->createPassword();
        $accountConfirmationCode = $this->createAccountConfirmationCode();

        $userFactory = new UserFactory();
        $user = $userFactory->create(
            $identifier,
            $email,
            $password,
            $accountConfirmationCode
        );

        return $user;
    }

    private function createIdentifier()
    {
        $identifierFactory = new IdentifierFactory();
        $identifier = $identifierFactory->create(static::IDENTIFIER);

        return $identifier;
    }

    private function createEmail(): Email
    {
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create(static::EMAIL);

        return $email;
    }

    private function createPassword(): Password
    {
        $passwordFactory = new PasswordFactory();
        $password = $passwordFactory->create(static::PASSWORD);

        return $password;
    }

    private function createAccountConfirmationCode(): AccountConfirmationCode
    {
        $accountConfirmationCodeFactory = new AccountConfirmationCodeFactory();
        $accountConfirmationCode = $accountConfirmationCodeFactory->create(static::ACCOUNT_CONFIRMATION_CODE);

        return $accountConfirmationCode;
    }
}