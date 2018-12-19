<?php

namespace cacf\services\signUp;

use cacf\infrastructure\repositories\UserRepository;
use cacf\models\EmailFactory;
use cacf\models\PasswordFactory;
use cacf\models\UserFactory;

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