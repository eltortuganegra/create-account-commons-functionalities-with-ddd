<?php


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\email\EmailFactory;
use cacf\models\identifier\IdentifierFactory;
use cacf\services\ServiceResponse;
use cacf\services\signUp\SignUpServiceFactory;

use cacf\services\signUp\SignUpServiceRequestFactory;
use PHPUnit\Framework\TestCase;

class SignUpServiceWithLechuckUserTest extends TestCase
{
    private $requestService;
    private $service;
    private $userRepository;
    private $emailNotification;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->buildServiceRequest();
        $this->buildUserRepository();
        $this->buildEmailNotification();
        $this->buildService();
    }

    private function buildServiceRequest(): void
    {
        $email = 'lechuck@thesecretofmonkeyisland.com';
        $password = 'pirate\'s life';
        $fromEmail = 'no-reply@themonkeyisland.com';
        $subject = 'Welcome!';
        $body = 'Your account has been create successfully.';

        $signUpServiceRequestFactory = new SignUpServiceRequestFactory();
        $this->requestService = $signUpServiceRequestFactory->create(
            $email,
            $password,
            $fromEmail,
            $subject,
            $body
        );
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

    private function buildService(): void
    {
        $serviceFactory = new SignUpServiceFactory();
        $this->service = $serviceFactory->create($this->userRepository, $this->emailNotification);
    }

    public function testSignUpServiceShouldReturnServiceResponse()
    {
        // Arrange
        $response = $this->service->execute($this->requestService);

        // Act
        $isServiceResponse = $response instanceof ServiceResponse;

        // Assert
        $this->assertEquals(true, $isServiceResponse);
    }

    public function testLeChuckUserShouldBeInTheRepositoryAfterSignInProcess()
    {
        // Arrange
        $response = $this->service->execute($this->requestService);
        $identifierFactory = new IdentifierFactory();
        $identifier = $identifierFactory->create($response->getIdentifierValue());

        // Act
        $user = $this->userRepository->find($identifier);

        // Assert
        $this->assertEquals($user->getIdentifier()->getValue(), $identifier->getValue());
    }

    public function testWelcomeEmailShouldBeSentWhenLeChuckHasBeenSignUpSuccessfully()
    {
        // Arrange
        $response = $this->service->execute($this->requestService);

        // Act
        $wasWelcomeEmailSent = $response->isWelcomeEmailNotificationSent();

        // Assert
        $this->assertTrue($wasWelcomeEmailSent);
    }



}
