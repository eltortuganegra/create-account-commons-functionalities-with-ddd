<?php


use cacf\models\password\PasswordFactory;
use PHPUnit\Framework\TestCase;

class PasswordPiratesLifeShouldReturnAnEncryptTextTest extends TestCase
{
    public function testPasswordPiratesLifeShouldReturnAnEncryptText()
    {
        // Arrange
        $passwordText = "Pirate's life";
        $passwordFactory = new PasswordFactory();
        $password = $passwordFactory->create($passwordText);

        // Act
        $isValid = password_verify($passwordText, $password->getText());

        // Assert
        $this->assertTrue($isValid);
    }

}