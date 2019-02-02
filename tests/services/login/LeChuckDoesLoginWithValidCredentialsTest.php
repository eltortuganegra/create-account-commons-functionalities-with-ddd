<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\services\login\LoginServiceFactory;
use cacf\services\login\LoginServiceRequestFactory;
use PHPUnit\Framework\TestCase;
use tests\fixtures\AddLeChuckToRepository;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class LeChuckDoesLoginWithValidCredentialsTest extends TestCase
{
    public function testLeChuckDoesLoginWithHisEmailAndPassword()
    {
        // Arrange
        $userRepository = $this->createUserRepository();
        $addLeChuckToRepository = new AddLeChuckToRepository($userRepository);
        $addLeChuckToRepository->execute();

        $email = LeChuckFixtureUserFactory::EMAIL;
        $password = LeChuckFixtureUserFactory::PASSWORD;

        $serviceRequestFactory = new LoginServiceRequestFactory();
        $serviceRequest = $serviceRequestFactory->create($email, $password);

        $loginServiceFactory = new LoginServiceFactory();
        $loginService = $loginServiceFactory->create($userRepository);
        $serviceResponse = $loginService->execute($serviceRequest);

        // Act
        $areCredentialsValid = $serviceResponse->areCredentialsValid();

        // Assert
        $this->assertTrue($areCredentialsValid);
    }

    private function createUserRepository(): \cacf\infrastructure\repositories\UserRepository
    {
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $userRepository = $userRepositoryFactory->create();

        return $userRepository;
    }

}