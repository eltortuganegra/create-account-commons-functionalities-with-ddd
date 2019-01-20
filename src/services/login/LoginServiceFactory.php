<?php


namespace cacf\services\login;


use cacf\infrastructure\repositories\UserRepository;
use cacf\models\email\EmailFactory;
use cacf\services\Service;

class LoginServiceFactory
{
    public function create(UserRepository $userRepository): Service
    {
        $loginServiceResponseFactory = new LoginServiceResponseFactory();
        $emailFactory = new EmailFactory();

        return new LoginService($userRepository, $loginServiceResponseFactory, $emailFactory);
    }

}