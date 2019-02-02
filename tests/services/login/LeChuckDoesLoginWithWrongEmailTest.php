<?php


use cacf\infrastructure\repositories\UserRepository;
use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\services\login\EmailNotFoundException;
use cacf\services\login\LoginServiceFactory;
use cacf\services\login\LoginServiceRequestFactory;
use PHPUnit\Framework\TestCase;
use tests\fixtures\AddLeChuckToRepository;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class LeChuckDoesLoginWithWrongEmailTest extends TestCase
{
    public function testItShouldThrowEmailNotFoundExceptionWhenWrongEmailIsUsed()
    {
        $this->expectException(EmailNotFoundException::class);

        // Arrange
        $userRepository = $this->createUserRepository();
        $addLeChuckToRepository = new AddLeChuckToRepository($userRepository);
        $addLeChuckToRepository->execute();

        $email = LeChuckFixtureUserFactory::EMAIL_WRONG;
        $password = LeChuckFixtureUserFactory::PASSWORD;

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