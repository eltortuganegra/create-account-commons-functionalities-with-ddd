<?php

use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\models\email\EmailFactory;
use PHPUnit\Framework\TestCase;

class FakeEmailNotificationTest extends TestCase
{
    public function testEmailShouldBeSent()
    {
        // Arrange
        $emailFactory = new EmailFactory();
        $toEmail = $emailFactory->create('largo.lagrande@themonkeyisland.com');
        $fromEmail = $emailFactory->create('lechuck@themonkeyisland.com');
        $subject = 'About your mission';
        $body = 'Burn down every island in the Caribbean if you have to, but bring me my bride!... and more slaw!';

        $signUpEmailNotification = $this->createSignUpEmailNotification();
        $signUpEmailNotification->send($toEmail, $fromEmail, $subject, $body);

        // Act
        $isSent = $signUpEmailNotification->isSent();

        // Assert
        $this->assertTrue($isSent);
    }

    private function createSignUpEmailNotification(): EmailNotification
    {
        $fakeSignUpEmailNotificationFactory = new FakeEmailNotificationFactory();
        $signUpEmailNotification = $fakeSignUpEmailNotificationFactory->create();

        return $signUpEmailNotification;
    }
}
