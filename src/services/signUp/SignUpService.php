<?php

namespace cacf\services\signUp;


use cacf\infrastructure\repositories\UserRepository;
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

    public function __construct(
        UserRepository $userRepository,
        SignUpServiceResponseFactory $signUpServiceResponseFactory,
        EmailFactory $emailFactory,
        PasswordFactory $passwordFactory,
        UserFactory $userFactory
    )
    {
        $this->signUpServiceResponseFactory = $signUpServiceResponseFactory;
        $this->userRepository = $userRepository;
        $this->emailFactory = $emailFactory;
        $this->passwordFactory = $passwordFactory;
        $this->userFactory = $userFactory;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $email = $this->emailFactory->create($serviceRequest->getEmail());
        $password = $this->passwordFactory->create($serviceRequest->getPassword());
        $user = $this->userFactory->create();
        $user->setIdentifier($this->userRepository->getNextIdentifier());
        $user->setEmail($email);
        $user->setPassword($password);

        $this->userRepository->add($user);

        return $this->signUpServiceResponseFactory->create($user->getIdentifier());
    }

}