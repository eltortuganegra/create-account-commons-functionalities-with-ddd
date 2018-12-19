<?php


use cacf\services\ServiceResponse;
use cacf\services\signUp\SignUpServiceFactory;

use cacf\services\signUp\SignUpServiceRequestFactory;
use PHPUnit\Framework\TestCase;

class SignUpServiceWithLechuckUserTest extends TestCase
{
    public function testSignUpServiceShouldReturnServiceResponse()
    {
        // Arrange
        $email = 'lechuck@thesecretofmonkeyisland.com';
        $password = 'pirate\'s life';

        $signUpServiceRequestFactory = new SignUpServiceRequestFactory();
        $request = $signUpServiceRequestFactory->create($email, $password);
        $serviceFactory = new SignUpServiceFactory();
        $service = $serviceFactory->create();
        $response = $service->execute($request);

        // Act
        $isServiceResponse = $response instanceof ServiceResponse;

        // Assert
        $this->assertEquals(true, $isServiceResponse);
    }

}
