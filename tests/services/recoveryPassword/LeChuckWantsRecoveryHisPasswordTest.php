<?php


use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\email\EmailFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\recoveryPassword\RecoveryPasswordServiceFactory;
use cacf\services\recoveryPassword\RecoveryPasswordServiceRequestFactory;
use tests\fixtures\user\FixtureUserFactory;
use PHPUnit\Framework\TestCase;

class leChuckWantsRecoveryHisPasswordTest extends TestCase
{
    private $serviceRequest;
    private $service;
    private $serviceResponse;
    private $userRepository;
    private $emailNotification;
    private $recoveryPasswordCodeFactory;

    public function setUp()
    {
        $this->createUserRepository();
        $this->createEmailNotification();
        $this->loadLeChuckUserInUserRepository();
        $this->createServiceRequestToLeChuckRecoveryPassword();
        $this->createRecoveryPasswordCodeFactory();
        $this->createRecoveryPasswordService();
        $this->executeRecoveryPasswordService();
    }

    private function createUserRepository(): void
    {
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $this->userRepository = $userRepositoryFactory->create();
    }

    private function createEmailNotification(): void
    {
        $emailNotificationFactory = new FakeEmailNotificationFactory();
        $this->emailNotification = $emailNotificationFactory->create();
    }

    private function loadLeChuckUserInUserRepository(): void
    {
        $fixtureUserFactory = new FixtureUserFactory();
        $leChuckUser = $fixtureUserFactory->createLeChuckUser();
        $this->userRepository->add($leChuckUser);
    }

    private function createServiceRequestToLeChuckRecoveryPassword()
    {
        $leChuckEmailAddress = 'lechuck@thesecretofmonkeyisland.com';
        $fromEmail = 'no-reply@thesecretofmonkeyisland.com';
        $subject = 'Recovery password';
        $body = 'This is the email to recovery password.';

        $serviceRequestFactory = new RecoveryPasswordServiceRequestFactory();
        $this->serviceRequest = $serviceRequestFactory->create(
            $leChuckEmailAddress,
            $fromEmail,
            $subject,
            $body
        );
    }

    private function createRecoveryPasswordCodeFactory(): void
    {
        $validRecoveryPasswordCode = '1d656b9a-ba35-4968-8b12-8eb9b3cb2a56';
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $recoveryPasswordCode = $recoveryPasswordCodeFactory->create($validRecoveryPasswordCode);

        $this->recoveryPasswordCodeFactory = $this->createMock(RecoveryPasswordCodeFactory::class);
        $this->recoveryPasswordCodeFactory->method('random')->willReturn($recoveryPasswordCode);
    }

    private function createRecoveryPasswordService()
    {
        $serviceFactory = new RecoveryPasswordServiceFactory();
        $this->service = $serviceFactory->create(
            $this->userRepository,
            $this->emailNotification,
            $this->recoveryPasswordCodeFactory
        );
    }

    private function executeRecoveryPasswordService(): void
    {
        $this->serviceResponse = $this->service->execute($this->serviceRequest);
    }

    public function testLeChuckShouldHaveARecoveryPasswordCodeWhenHeRecoveryHisPassword()
    {
        // Arrange
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create('lechuck@thesecretofmonkeyisland.com');
        $user = $this->userRepository->findByEmail($email);
        $recoveryPasswordCode = $user->getRecoveryPasswordCode();

        // Act
        $isString = ! empty($recoveryPasswordCode);

        // Assert
        $this->assertTrue($isString);
    }

    public function testLeChuckShouldHaveTheDefaultRecoveryPasswordCodeWhenHeRecoveryHisPassword()
    {
        // Arrange
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create('lechuck@thesecretofmonkeyisland.com');
        $user = $this->userRepository->findByEmail($email);

        // Act
        $recoveryPasswordCode = $user->getRecoveryPasswordCode();

        // Assert
        $this->assertEquals('1d656b9a-ba35-4968-8b12-8eb9b3cb2a56', $recoveryPasswordCode->getCode());
    }

    public function testAnRecoveryPasswordEmailShouldBeSentWhenLeChuckRecoveryHisPassword()
    {
        // Act
        $isRecoveryEmailSent = $this->serviceResponse->isRecoveryPasswordEmailNotificationSent();

        // Assert
        $this->assertTrue($isRecoveryEmailSent);
    }

}