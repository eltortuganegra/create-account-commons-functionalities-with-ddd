<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCode;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\models\user\User;
use cacf\services\resetPassword\ResetPasswordServiceFactory;
use cacf\services\resetPassword\ResetPasswordServiceRequest;
use cacf\services\resetPassword\ResetPasswordServiceRequestFactory;
use PHPUnit\Framework\TestCase;
use tests\fixtures\password\PasswordFactoryFixture;
use tests\fixtures\recoveryPasswordCode\RecoveryPasswordCodeFactoryFixture;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class LeChuckResetHisAccountPasswordTest extends TestCase
{
    private $userRepository;
    private $leChuckUser;
    private $serviceRequest;
    private $service;
    private $serviceResponse;

    public function setUp()
    {
        $this->createUserRepository();
        $this->createLeChuckUser();
        $this->addLeChuckToUserRepository();
        $this->updateLeChuckWithDefaultRecoveryPasswordCode();
        $this->updateUserRepositoryWithLechuck();
        $this->createServiceRequest();
        $this->createService();
        $this->executeService();
    }

    private function createUserRepository()
    {
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $this->userRepository = $userRepositoryFactory->create();
    }

    private function createLeChuckUser(): void
    {
        $leChuckFixtureUserFactory = new LeChuckFixtureUserFactory();
        $this->leChuckUser = $leChuckFixtureUserFactory->create();
    }

    private function addLeChuckToUserRepository(): void
    {
        $this->userRepository->add($this->leChuckUser);
    }

    private function updateLeChuckWithDefaultRecoveryPasswordCode(): void
    {
        $recoveryPasswordCode = $this->getDefaultRecoveryPasswordCode();
        $this->leChuckUser->recoveryPassword($recoveryPasswordCode);
    }

    private function getDefaultRecoveryPasswordCode(): RecoveryPasswordCode
    {
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $recoveryPasswordCode = $recoveryPasswordCodeFactory->create(RecoveryPasswordCodeFactoryFixture::DEFAULT_CODE);

        return $recoveryPasswordCode;
    }

    private function updateUserRepositoryWithLechuck(): void
    {
        $this->userRepository->update($this->leChuckUser);
    }

    private function createServiceRequest()
    {
        $recoveryPasswordCode = RecoveryPasswordCodeFactoryFixture::DEFAULT_CODE;
        $password = PasswordFactoryFixture::DEFAULT;
        $serviceRequestFactory = new ResetPasswordServiceRequestFactory();
        $this->serviceRequest = $serviceRequestFactory->create($recoveryPasswordCode, $password);
    }

    private function createService(): void
    {
        $serviceFactory = new ResetPasswordServiceFactory();
        $this->service = $serviceFactory->create($this->userRepository);
    }

    private function executeService(): void
    {
        $this->serviceResponse = $this->service->execute($this->serviceRequest);
    }

    public function testAccountPasswordShouldBeUpdatedWhenLeChuckResetHisAccountPassword()
    {
        // Arrange
        $leChuck = $this->findLeChuckFromRepository();

        // Act
        $isPasswordValid = $leChuck->verifyPassword(PasswordFactoryFixture::DEFAULT);

        // Assert
        $this->assertTrue($isPasswordValid);
    }

    private function findLeChuckFromRepository(): User
    {
        $user = $this->userRepository->findByEmail(
            $this->leChuckUser->getEmail()
        );

        return $user;
    }

    public function testNobodyShouldBeFoundByTheDefaultRecoveryPasswordCodeWhenLeChuckResetHisPassword()
    {
        // Arrange
        $recoveryPasswordCode = $this->getDefaultRecoveryPasswordCode();
        $nobody = $this->userRepository->findByRecoveryPasswordCode($recoveryPasswordCode);

        // Act
        $nobodyIsFound = ($nobody === null);

        // Assert
        $this->assertTrue($nobodyIsFound);
    }
}