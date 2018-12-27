<?php


use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\email\EmailFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\services\recoveryPassword\RecoveryPasswordServiceFactory;
use cacf\services\recoveryPassword\RecoveryPasswordServiceRequestFactory;
use tests\fixtures\user\FixtureUserFactory;
use PHPUnit\Framework\TestCase;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class leChuckWantsRecoveryHisPasswordTest extends TestCase
{
    private $serviceRequest;
    private $service;
    private $serviceResponse;
    private $userRepository;
    private $emailNotification;

    public function setUp()
    {
        $this->createUserRepository();
        $this->createEmailNotification();
        $this->loadLeChuckUserInUserRepository();
        $this->createServiceRequestToLeChuckRecoveryPassword();
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
        $leChuckFixtureUserFactory = new LeChuckFixtureUserFactory();
        $leChuckUser = $leChuckFixtureUserFactory->create();
        $this->userRepository->add($leChuckUser);
    }

    private function createServiceRequestToLeChuckRecoveryPassword()
    {
        $leChuckEmailAddress = 'lechuck@thesecretofmonkeyisland.com';
        $recoveryPasswordCode = '1d656b9a-ba35-4968-8b12-8eb9b3cb2a56';
        $fromEmail = 'no-reply@thesecretofmonkeyisland.com';
        $subject = 'Recovery password';
        $body = 'This is the content of email to recovery password.';

        $serviceRequestFactory = new RecoveryPasswordServiceRequestFactory();
        $this->serviceRequest = $serviceRequestFactory->create(
            $leChuckEmailAddress,
            $recoveryPasswordCode,
            $fromEmail,
            $subject,
            $body
        );
    }

    private function createRecoveryPasswordService()
    {
        $serviceFactory = new RecoveryPasswordServiceFactory();
        $this->service = $serviceFactory->create(
            $this->userRepository,
            $this->emailNotification
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