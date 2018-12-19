<?php


use cacf\models\email\Email;
use cacf\models\email\EmailFactory;
use PHPUnit\Framework\TestCase;

class EmailValidTest extends TestCase
{
    private $email;

    public function setUp()
    {
        // Arrange
        $emailText = 'lechuck@themonkeyisland.com';
        $emailFactory = new EmailFactory();
        $this->email = $emailFactory->create($emailText);
    }

    public function testEmailFactoryShouldReturnAndEmail()
    {
        // Act
        $isEmail = $this->email instanceof Email;

        // Assert
        $this->assertEquals(true, $isEmail);
    }

    public function testEmailShouldContainsLeChuckMail()
    {
        // Act
        $returnedEmail = $this->email->getEmailText();

        // Assert
        $this->assertEquals($returnedEmail, 'lechuck@themonkeyisland.com');
    }

}
