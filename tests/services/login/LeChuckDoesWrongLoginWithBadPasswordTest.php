<?php


use cacf\infrastructure\repositories\UserRepository;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\services\login\LoginServiceFactory;
use cacf\services\login\LoginServiceRequestFactory;
use cacf\services\login\PasswordNotMatchException;
use PHPUnit\Framework\TestCase;
use tests\fixtures\AddLeChuckToRepository;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class LeChuckDoesWrongLoginWithBadPasswordTest extends TestCase
{
    public function testItShouldThrowWrongPasswordExceptionWhenBadPasswordIsUsed()
    {
        $this->expectException(PasswordNotMatchException::class);

        // Arrange
        $userRepository = $this->createUserRepository();
        $addLeChuckToRepository = new AddLeChuckToRepository($userRepository);
        $addLeChuckToRepository->execute();

        $email = LeChuckFixtureUserFactory::EMAIL;
        $password = LeChuckFixtureUserFactory::PASSWORD_INVALID;

        $serviceRequestFactory = new LoginServiceRequestFactory();
        $serviceRequest = $serviceRequestFactory->create($email, $password);

        $loginServiceFactory = new LoginServiceFactory();
        $loginService = $loginServiceFactory->create($userRepository);
        $loginService->execute($serviceRequest);
    }

    private function createUserRepository(): UserRepository
    {
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $userRepository = $userRepositoryFactory->create();

        return $userRepository;
    }
}