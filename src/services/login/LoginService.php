<?php


namespace cacf\services\login;


use cacf\infrastructure\repositories\UserRepository;
use cacf\models\email\EmailFactory;
use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class LoginService implements Service
{
    private $loginServiceResponseFactory;
    private $userRepository;
    private $emailFactory;
    private $email;
    private $user;

    public function __construct(
        UserRepository $userRepository,
        LoginServiceResponseFactory $loginServiceResponseFactory,
        EmailFactory $emailFactory
    ) {
        $this->userRepository = $userRepository;
        $this->loginServiceResponseFactory = $loginServiceResponseFactory;
        $this->emailFactory = $emailFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $this->loadEmailFromServiceRequest($serviceRequest);
        $this->loadUserFromRepository();
        if ( ! $this->isPasswordValid($serviceRequest->getPlainTextPassword())) {
            throw new PasswordNotMatchException();
        }

        $serviceResponse = $this->buildSuccessLoginResponse();

        return $serviceResponse;
    }

    private function loadEmailFromServiceRequest(ServiceRequest $serviceRequest): void
    {
        $this->email = $this->emailFactory->create($serviceRequest->getEmailAddress());
    }

    private function loadUserFromRepository(): void
    {
        $this->user = $this->userRepository->findByEmail($this->email);
    }

    private function isPasswordValid(string $plainTextPassword): bool
    {
        $password = $this->user->getPassword();

        return $password->verify($plainTextPassword);
    }

    private function buildSuccessLoginResponse(): ServiceResponse
    {
        $validCredentials = true;
        $identifierValue = $this->user->getIdentifier()->getValue();
        $emailAddress = $this->user->getEmail()->getEmailText();

        $serviceResponse = $this->loginServiceResponseFactory->create($validCredentials, $identifierValue, $emailAddress);

        return $serviceResponse;
    }

}