<?php


use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\identifier\IdentifierFactory;
use cacf\services\confirmAccount\ConfirmAccountServiceFactory;
use cacf\services\confirmAccount\ConfirmAccountServiceRequestFactory;
use cacf\services\ServiceResponse;
use cacf\services\signUp\SignUpServiceFactory;
use cacf\services\signUp\SignUpServiceRequestFactory;
use PHPUnit\Framework\TestCase;

class LeChuckConfirmHisAccount extends TestCase
{
    private $userRepository;
    private $emailNotification;
    private $signUpService;
    private $signUpServiceRequest;
    private $confirmAccountService;

    public function setUp()
    {
        $this->buildUserRepository();
        $this->buildEmailNotification();
        $this->buildSignUpService();
        $this->buildConfirmAccountService();
    }

    private function buildUserRepository(): void
    {
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $this->userRepository = $userRepositoryFactory->create();
    }

    private function buildEmailNotification(): void
    {
        $emailNotificationFactory = new FakeEmailNotificationFactory();
        $this->emailNotification = $emailNotificationFactory->create();
    }

    private function buildSignUpService(): void
    {
        $serviceFactory = new SignUpServiceFactory();
        $this->signUpService = $serviceFactory->create($this->userRepository, $this->emailNotification);
    }

    private function buildConfirmAccountService(): void
    {
        $serviceFactory = new ConfirmAccountServiceFactory();
        $this->confirmAccountService = $serviceFactory->create($this->userRepository);
    }

    private function buildSignUpServiceRequestWithLeChuckInputData(): void
    {
        $email = 'lechuck@thesecretofmonkeyisland.com';
        $password = 'pirate\'s life';
        $fromEmail = 'no-reply@themonkeyisland.com';
        $subject = 'Welcome!';
        $body = 'Your account has been create successfully.';

        $signUpServiceRequestFactory = new SignUpServiceRequestFactory();
        $this->signUpServiceRequest = $signUpServiceRequestFactory->create(
            $email,
            $password,
            $fromEmail,
            $subject,
            $body
        );
    }

    public function testServiceShouldConfirmTheAccountWhenLeChuckUseConfirmAccountCode()
    {
        // Arrange
        $this->buildSignUpServiceRequestWithLeChuckInputData();
        $signUpServiceResponse = $this->executeSignUpService();

        $identifierFactory = new IdentifierFactory();
        $identifier = $identifierFactory->create($signUpServiceResponse->getIdentifierValue());
        $user = $this->userRepository->find($identifier);
        $accountConfirmationCode = $user->getAccountConfirmationCode();

        $confirmAccountServiceRequestFactory = new ConfirmAccountServiceRequestFactory();
        $serviceRequest = $confirmAccountServiceRequestFactory->create($accountConfirmationCode->getCode());

        $response = $this->confirmAccountService->execute($serviceRequest);

        // Act
        $isAccountConfirmed = $response->getIsAccountConfirmed();

        // Assert
        $this->assertTrue($isAccountConfirmed);

        // Act
        $user = $this->userRepository->find($identifier);

        // Assert
        $this->assertTrue($user->isAccountConfirmed());
    }

    private function executeSignUpService(): ServiceResponse
    {
        $response = $this->signUpService->execute($this->signUpServiceRequest);

        return $response;
    }


}