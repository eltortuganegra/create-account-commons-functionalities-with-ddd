<?php


namespace cacf\services\recoveryPassword;


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\repositories\UserRepository;
use cacf\services\Service;

class RecoveryPasswordServiceFactory
{
    public function create(
        UserRepository $userRepository,
        EmailNotification $emailNotification
    ): Service
    {
        return new RecoveryPasswordService($userRepository, $emailNotification);
    }
}