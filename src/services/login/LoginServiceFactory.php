<?php


namespace cacf\services\login;


use cacf\infrastructure\repositories\UserRepository;
use cacf\services\Service;

class LoginServiceFactory
{
    public function create(UserRepository $userRepository): Service
    {
        $loginServiceResponseFactory = new LoginServiceResponseFactory();

        return new LoginService($userRepository, $loginServiceResponseFactory);
    }

}