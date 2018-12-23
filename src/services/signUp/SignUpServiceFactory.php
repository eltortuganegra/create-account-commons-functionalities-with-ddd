<?php

namespace cacf\services\signUp;

use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\repositories\UserRepository;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\models\email\EmailFactory;
use cacf\models\password\PasswordFactory;
use cacf\models\user\UserFactory;

class SignUpServiceFactory
{
    public function create(UserRepository $userRepository, EmailNotification $emailNotification)
    {
        $signUpServiceResponseFactory = new SignUpServiceResponseFactory();
        $emailFactory = new EmailFactory();
        $passwordFactory = new PasswordFactory();
        $userFactory = new UserFactory();
        $accountConfirmationCodeFactory = new AccountConfirmationCodeFactory();

        return new SignUpService(
            $userRepository,
            $signUpServiceResponseFactory,
            $emailFactory,
            $passwordFactory,
            $userFactory,
            $emailNotification,
            $accountConfirmationCodeFactory
        );
    }

}