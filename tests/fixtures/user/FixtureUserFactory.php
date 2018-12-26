<?php

namespace tests\fixtures\user;

use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\models\email\Email;
use cacf\models\email\EmailFactory;
use cacf\models\password\Password;
use cacf\models\password\PasswordFactory;
use cacf\models\user\User;
use cacf\models\user\UserFactory;

class FixtureUserFactory
{
    public function createLeChuckUser(): User
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
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $userRepository = $userRepositoryFactory->create();
        $identifier = $userRepository->getNextIdentifier();

        return $identifier;
    }

    private function createEmail(): Email
    {
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create('lechuck@thesecretofmonkeyisland.com');

        return $email;
    }

    private function createPassword(): Password
    {
        $passwordFactory = new PasswordFactory();
        $password = $passwordFactory->create('validpassword');

        return $password;
    }

    private function createAccountConfirmationCode(): AccountConfirmationCode
    {
        $accountConfirmationCodeFactory = new AccountConfirmationCodeFactory();
        $accountConfirmationCode = $accountConfirmationCodeFactory->create('validAccountConfirmationCode');

        return $accountConfirmationCode;
    }
}