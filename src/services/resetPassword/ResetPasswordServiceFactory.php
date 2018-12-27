<?php


namespace cacf\services\resetPassword;


use cacf\infrastructure\repositories\UserRepository;
use cacf\models\password\PasswordFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\Service;

class ResetPasswordServiceFactory
{
    public function create(UserRepository $userRepository): Service
    {
        $resetPasswordServiceResponse = new ResetPasswordServiceResponseFactory();
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $passwordFactory = new PasswordFactory();

        return new ResetPasswordService(
            $userRepository,
            $resetPasswordServiceResponse,
            $recoveryPasswordCodeFactory,
            $passwordFactory
        );
    }

}