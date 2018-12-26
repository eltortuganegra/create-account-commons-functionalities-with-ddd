<?php


namespace cacf\services\recoveryPassword;


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\repositories\UserRepository;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\Service;

class RecoveryPasswordServiceFactory
{
    public function create(
        UserRepository $userRepository,
        EmailNotification $emailNotification,
        RecoveryPasswordCodeFactory $recoveryPasswordCodeFactory
    ): Service
    {
        $randomRecoveryPassword = $recoveryPasswordCodeFactory->random();

        return new RecoveryPasswordService($userRepository, $emailNotification, $randomRecoveryPassword);
    }
}