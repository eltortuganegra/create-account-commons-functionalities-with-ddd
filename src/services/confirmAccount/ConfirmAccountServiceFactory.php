<?php

namespace cacf\services\confirmAccount;

use cacf\infrastructure\repositories\UserRepository;
use cacf\services\Service;

class ConfirmAccountServiceFactory
{
    public function create(UserRepository $userRepository): Service
    {
        return new ConfirmAccountService($userRepository);
    }
}