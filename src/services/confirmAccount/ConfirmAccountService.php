<?php

namespace cacf\services\confirmAccount;


use cacf\infrastructure\repositories\UserRepository;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\services\Service;
use cacf\services\ServiceRequest;
use cacf\services\ServiceResponse;

class ConfirmAccountService implements Service
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ServiceRequest $serviceRequest): ServiceResponse
    {
        $accountConfirmationCodeFactory = new AccountConfirmationCodeFactory();
        $accountConfirmationCode = $accountConfirmationCodeFactory->create($serviceRequest->getConfirmAccountCode());
        $user = $this->userRepository->findByAccountConfirmationCode($accountConfirmationCode);
        $user->confirmAccount();
        $this->userRepository->update($user);

        $serviceResponseFactory = new ConfirmAccountServiceResponseFactory();
        $serviceResponse = $serviceResponseFactory->create(true);

        return $serviceResponse;
    }
}