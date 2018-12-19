<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\UserFactory;
use PHPUnit\Framework\TestCase;

class UserRepositoryInMemoryTest extends TestCase
{
    public function testItShouldAddUserToRepository()
    {
        // Arrange
        $userRepositoryInMemoryFactory = new UserRepositoryInMemoryFactory();
        $userRepository = $userRepositoryInMemoryFactory->create();

        $userFactory = new UserFactory();
        $user = $userFactory->create();
        $user->setIdentifier($userRepository->getNextIdentifier());
        $userRepository->add($user);

        // Act
        $returnedUser = $userRepository->find($user->getIdentifier());

        // Assert
        $this->assertEquals($returnedUser, $user);
    }

}
