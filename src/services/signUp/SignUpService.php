<?php

namespace cacf\services\signUp;

use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\repositories\UserRepository;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\models\email\EmailFactory;
use cacf\models\password\PasswordFactory;
use cacf\models\user\UserFactory;
use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class SignUpService implements Service
{
    private $signUpServiceResponseFactory;
    private $userRepository;
    private $emailFactory;
    private $passwordFactory;
    private $userFactory;
    private $emailNotification;
    private $user;
    private $serviceResponse;
    private $accountConfirmationCodeFactory;

    public function __construct(
        UserRepository $userRepository,
        SignUpServiceResponseFactory $signUpServiceResponseFactory,
        EmailFactory $emailFactory,
        PasswordFactory $passwordFactory,
        UserFactory $userFactory,
        EmailNotification $emailNotification,
        AccountConfirmationCodeFactory $accountConfirmationCodeFactory
    )
    {
        $this->signUpServiceResponseFactory = $signUpServiceResponseFactory;
        $this->userRepository = $userRepository;
        $this->emailFactory = $emailFactory;
        $this->passwordFactory = $passwordFactory;
        $this->userFactory = $userFactory;
        $this->emailNotification = $emailNotification;
        $this->accountConfirmationCodeFactory = $accountConfirmationCodeFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $this->createUser($serviceRequest);
        $this->addUserToRepository();
        $this->sendSignUpEmailNotification($serviceRequest);
        $this->createResponse();

        return $this->serviceResponse;
    }

    private function createUser(ServiceRequest $serviceRequest)
    {
        $email = $this->emailFactory->create($serviceRequest->getEmail());
        $password = $this->passwordFactory->create($serviceRequest->getPassword());
        $this->user = $this->userFactory->create();
        $this->user->setIdentifier($this->userRepository->getNextIdentifier());
        $this->user->setEmail($email);
        $this->user->setPassword($password);
        $this->user->setAccountConfirmationCode($this->accountConfirmationCodeFactory->random());
    }

    private function addUserToRepository(): void
    {
        $this->userRepository->add($this->user);
    }

    private function createResponse()
    {
        $this->serviceResponse = $this->signUpServiceResponseFactory->create(
            $this->user->getIdentifier(),
            $this->emailNotification->isSent()
        );
    }

    private function sendSignUpEmailNotification(ServiceRequest $serviceRequest): void
    {
        $emailFactory = new EmailFactory();
        $toEmail = $emailFactory->create($serviceRequest->getEmail());
        $fromEmail = $emailFactory->create($serviceRequest->getFromEmail());

        $this->emailNotification->send(
            $toEmail,
            $fromEmail,
            $serviceRequest->getSubject(),
            $serviceRequest->getBody()
        );
    }

}