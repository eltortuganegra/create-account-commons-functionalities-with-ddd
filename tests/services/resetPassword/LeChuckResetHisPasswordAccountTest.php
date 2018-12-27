<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;
use cacf\models\user\User;
use cacf\services\resetPassword\ResetPasswordServiceFactory;
use cacf\services\resetPassword\ResetPasswordServiceRequest;
use cacf\services\resetPassword\ResetPasswordServiceRequestFactory;
use PHPUnit\Framework\TestCase;
use tests\fixtures\password\PasswordFactoryFixture;
use tests\fixtures\recoveryPasswordCode\RecoveryPasswordCodeFactoryFixture;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class LeChuckResetHisPasswordAccountTest extends TestCase
{
    private $userRepository;
    private $leChuckUser;

    public function setUp()
    {
        $this->createUserRepository();
        $this->createLeChuckUser();
        $this->addLeChuckToUserRepository();
        $this->updateLeChuckWithDefaultRecoveryPasswordCode();
        $this->updateUserRepositoryWithLechuck();
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
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $recoveryPasswordCode = $recoveryPasswordCodeFactory->create(RecoveryPasswordCodeFactoryFixture::DEFAULT_CODE);
        $this->leChuckUser->recoveryPassword($recoveryPasswordCode);
    }

    private function updateUserRepositoryWithLechuck(): void
    {
        $this->userRepository->update($this->leChuckUser);
    }

    public function testAccountPasswordShouldBeUpdatedWhenLeChuckResetHisAccountPassword()
    {
        // Arrange
        $serviceRequest = $this->createServiceRequest();

        $serviceFactory = new ResetPasswordServiceFactory();
        $service = $serviceFactory->create($this->userRepository);
        $serviceResponse = $service->execute($serviceRequest);

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

    private function createServiceRequest(): ResetPasswordServiceRequest
    {
        $recoveryPasswordCode = RecoveryPasswordCodeFactoryFixture::DEFAULT_CODE;
        $password = PasswordFactoryFixture::DEFAULT;
        $serviceRequestFactory = new ResetPasswordServiceRequestFactory();
        $serviceRequest = $serviceRequestFactory->create($recoveryPasswordCode, $password);

        return $serviceRequest;
    }

}