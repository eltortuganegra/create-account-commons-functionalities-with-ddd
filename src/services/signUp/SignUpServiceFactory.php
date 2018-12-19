<?php

namespace cacf\services\signUp;

use cacf\infrastructure\repositories\UserRepository;
use cacf\models\email\EmailFactory;
use cacf\models\password\PasswordFactory;
use cacf\models\user\UserFactory;

class SignUpServiceFactory
{
    public function create(UserRepository $userRepository)
    {
        $signUpServiceResponseFactory = new SignUpServiceResponseFactory();
        $emailFactory = new EmailFactory();
        $passwordFactory = new PasswordFactory();
        $userFactory = new UserFactory();

        return new SignUpService(
            $userRepository,
            $signUpServiceResponseFactory,
            $emailFactory,
            $passwordFactory,
            $userFactory
        );
    }

}