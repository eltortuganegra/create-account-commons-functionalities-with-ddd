<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\accountConfirmationCode\AccountConfirmationCodeFactory;
use cacf\models\email\Email;
use cacf\models\email\EmailFactory;
use cacf\models\password\Password;
use cacf\models\password\PasswordFactory;
use cacf\models\user\User;
use cacf\models\user\UserFactory;
use PHPUnit\Framework\TestCase;

class UserRepositoryInMemoryTest extends TestCase
{
    private $userRepository;
    private $user;

    public function testItShouldAddUserToRepository()
    {
        // Arrange
        $this->createUserRepository();
        $this->createLeChuckUser();
        $this->addLeChuckUserToUserRepository();

        // Act
        $returnedUser = $this->findLeChuckAtUserRepository();

        // Assert
        $this->assertEquals($returnedUser, $this->user);
    }

    private function createUserRepository(): void
    {
        $userRepositoryInMemoryFactory = new UserRepositoryInMemoryFactory();
        $this->userRepository = $userRepositoryInMemoryFactory->create();
    }

    private function createLeChuckUser(): void
    {
        $email = $this->getLeChuckEmail();
        $password = $this->getLeChuckPassword();
        $accountConfirmationCode = $this->getLeChuckAccountConfirmationCode();

        $userFactory = new UserFactory();
        $this->user = $userFactory->create(
            $this->userRepository->getNextIdentifier(),
            $email,
            $password,
            $accountConfirmationCode
        );
    }

    private function getLeChuckEmail(): Email
    {
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create('lechuck@themonkeyisland.com');

        return $email;
    }

    private function getLeChuckPassword(): Password
    {
        $passwordFactory = new PasswordFactory();
        $password = $passwordFactory->create('amazingpassword');

        return $password;
    }

    private function getLeChuckAccountConfirmationCode(): AccountConfirmationCode
    {
        $accountConfirmationCodeFactory = new AccountConfirmationCodeFactory();
        $accountConfirmationCode = $accountConfirmationCodeFactory->create('validAccountConfirmationCode');

        return $accountConfirmationCode;
    }

    private function addLeChuckUserToUserRepository(): void
    {
        $this->userRepository->add($this->user);
    }

    private function findLeChuckAtUserRepository(): User
    {
        $returnedUser = $this->userRepository->find($this->user->getIdentifier());

        return $returnedUser;
    }
}
