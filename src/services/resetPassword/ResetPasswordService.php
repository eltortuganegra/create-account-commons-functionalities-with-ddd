<?php


namespace cacf\services\resetPassword;


use cacf\infrastructure\repositories\UserRepository;
use cacf\models\password\PasswordFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class ResetPasswordService implements Service
{
    private $userRepository;
    private $resetPasswordServiceResponseFactory;
    private $recoveryPasswordCodeFactory;
    private $serviceResponse;
    private $passwordFactory;

    public function __construct(
        UserRepository $userRepository,
        ResetPasswordServiceResponseFactory $resetPasswordServiceResponseFactory,
        RecoveryPasswordCodeFactory $recoveryPasswordCodeFactory,
        PasswordFactory $passwordFactory
    ) {
        $this->resetPasswordServiceResponseFactory = $resetPasswordServiceResponseFactory;
        $this->userRepository = $userRepository;
        $this->recoveryPasswordCodeFactory = $recoveryPasswordCodeFactory;
        $this->passwordFactory = $passwordFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $user = $this->findUserByRecoveryPasswordCode($serviceRequest);
        $password = $this->createPassword($serviceRequest);
        $this->resetUserPassword($user, $password);
        $this->updateUserRepository($user);

        $this->createServiceResponse(true);

        return $this->serviceResponse;
    }

    private function createServiceResponse(bool $wasPasswordReset): void
    {
        $this->serviceResponse = $this->resetPasswordServiceResponseFactory->create($wasPasswordReset);
    }

    private function findUserByRecoveryPasswordCode(ServiceRequest $serviceRequest): \cacf\models\user\User
    {
        $recoveryPasswordCode = $this->recoveryPasswordCodeFactory->create($serviceRequest->getRecoveryPasswordCode());
        $user = $this->userRepository->findByRecoveryPasswordCode($recoveryPasswordCode);

        return $user;
    }

    private function createPassword(ServiceRequest $serviceRequest): \cacf\models\password\Password
    {
        $password = $this->passwordFactory->create($serviceRequest->getPassword());

        return $password;
    }

    private function updateUserRepository($user): void
    {
        $this->userRepository->update($user);
    }

    private function resetUserPassword($user, $password): void
    {
        $user->resetPassword($password);
    }
}