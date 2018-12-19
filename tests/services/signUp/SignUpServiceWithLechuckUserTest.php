<?php


use cacf\infrastructure\repositories\UserRepositoryInMemoryFactory;
use cacf\models\IdentifierFactory;
use cacf\models\User;
use cacf\services\ServiceResponse;
use cacf\services\signUp\SignUpServiceFactory;

use cacf\services\signUp\SignUpServiceRequestFactory;
use PHPUnit\Framework\TestCase;

class SignUpServiceWithLechuckUserTest extends TestCase
{
    private $requestService;
    private $service;
    private $userRepository;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $email = 'lechuck@thesecretofmonkeyisland.com';
        $password = 'pirate\'s life';
        $signUpServiceRequestFactory = new SignUpServiceRequestFactory();
        $this->requestService = $signUpServiceRequestFactory->create($email, $password);
        $serviceFactory = new SignUpServiceFactory();
        $userRepositoryFactory = new UserRepositoryInMemoryFactory();
        $this->userRepository = $userRepositoryFactory->create();
        $this->service = $serviceFactory->create($this->userRepository);
    }

    public function testSignUpServiceShouldReturnServiceResponse()
    {
        // Arrange
        $response = $this->service->execute($this->requestService);

        // Act
        $isServiceResponse = $response instanceof ServiceResponse;

        // Assert
        $this->assertEquals(true, $isServiceResponse);
    }

    public function testLeChuckUserShouldBeInTheRepositoryAfterSignInProcess()
    {
        // Arrange
        $response = $this->service->execute($this->requestService);
        $identifierFactory = new IdentifierFactory();
        $identifier = $identifierFactory->create($response->getIdentifierValue());

        // Act
        $user = $this->userRepository->find($identifier);

        // Assert
        $this->assertEquals($user->getIdentifier()->getValue(), $identifier->getValue());
    }

}
