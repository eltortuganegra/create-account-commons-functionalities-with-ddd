<?php


namespace cacf\services\recoveryPassword;


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\repositories\UserRepository;
use cacf\models\email\EmailFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class RecoveryPasswordService implements Service
{
    private $serviceResponse;
    private $userRepository;
    private $user;
    private $emailNotification;

    public function __construct(
        UserRepository $userRepository,
        EmailNotification $emailNotification
    ) {
        $this->userRepository = $userRepository;
        $this->emailNotification = $emailNotification;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $this->findUserInRepository($serviceRequest);
        $this->recoveryPasswordForUser($serviceRequest);
        $this->updateUserInRepository();
        $this->sendEmailNotification($serviceRequest);
        $this->createServiceResponse();

        return $this->serviceResponse;
    }

    private function findUserInRepository(ServiceRequest $serviceRequest): void
    {
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create($serviceRequest->getRecoveryEmailAddress());
        $this->user = $this->userRepository->findByEmail($email);
    }

    private function createServiceResponse(): void
    {
        $serviceResponseFactory = new RecoveryPasswordServiceResponseFactory();
        $this->serviceResponse = $serviceResponseFactory->create($this->emailNotification->isSent());
    }

    private function recoveryPasswordForUser(ServiceRequest $serviceRequest): void
    {
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $recoveryPasswordCode = $recoveryPasswordCodeFactory->create($serviceRequest->getRecoveryPasswordCode());

        $this->user->recoveryPassword($recoveryPasswordCode);
    }

    private function updateUserInRepository()
    {
        $this->userRepository->update($this->user);
    }

    private function sendEmailNotification(ServiceRequest $serviceRequest)
    {
        $toEmail = $this->user->getEmail();
        $emailFactory = new EmailFactory();
        $fromEmail = $emailFactory->create($serviceRequest->getFromEmail());
        $subject = $serviceRequest->getSubject();
        $body = $serviceRequest->getBody();

        $this->emailNotification->send($toEmail, $fromEmail, $subject, $body);
    }
}