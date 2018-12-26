<?php


use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\email\EmailIsNotValidException;
use cacf\services\signUp\SignUpServiceFactory;
use cacf\services\signUp\SignUpServiceRequestFactory;
use PHPUnit\Framework\TestCase;

class SignUpServiceWithInvalidEmailTest extends TestCase
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
        $email = 'this is not a valid mail.com';
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

    public function testServiceShouldThrowAnExceptionWhenEmailIsNotValid()
    {
        // Assert
        $this->expectException(EmailIsNotValidException::class);

        // Arrange
        $response = $this->service->execute($this->requestService);
    }

}