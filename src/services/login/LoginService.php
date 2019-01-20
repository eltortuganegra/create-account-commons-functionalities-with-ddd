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

    public function __construct(
        UserRepository $userRepository,
        LoginServiceResponseFactory $loginServiceResponseFactory
    ) {
        $this->userRepository = $userRepository;
        $this->loginServiceResponseFactory = $loginServiceResponseFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create($serviceRequest->getEmailAddress());

        $user = $this->userRepository->findByEmail($email);

        $password = $user->getPassword();
        if ($password->verify($serviceRequest->getPlainTextPassword())) {
            $validCredentials = true;
            $identifierValue = $user->getIdentifier()->getValue();
            $emailAddress = $user->getEmail()->getEmailText();

            $serviceResponse = $this->loginServiceResponseFactory->create($validCredentials , $identifierValue, $emailAddress);
        }

        return $serviceResponse;
    }
}