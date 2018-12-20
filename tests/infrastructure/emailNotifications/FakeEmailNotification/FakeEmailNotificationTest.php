<?php

use cacf\infrastructure\emailNotifications\fakeEmailNotification\FakeEmailNotificationFactory;
use cacf\models\email\EmailFactory;
use PHPUnit\Framework\TestCase;

class FakeEmailNotificationTest extends TestCase
{
    public function testEmailShouldBeSent()
    {
        // Arrange
        $emailText = 'pirate@themonkeyisland.com';
        $body = 'You have been signed up successfully.';
        $emailFactory = new EmailFactory();
        $email = $emailFactory->create($emailText);
        $subject = 'About your mission';
        $body = 'Burn down every island in the Caribbean if you have to, but bring me my bride!... and more slaw!';
        $headers = 'From: lechuck@themonkeyisland.com' . "\r\n" .
                   'Reply-To: lechuck@themonkeyisland.com' . "\r\n";

        $fakeSignUpEmailNotificationFactory = new FakeEmailNotificationFactory();
        $signUpEmailNotification = $fakeSignUpEmailNotificationFactory->create($email, $subject, $body, $headers);
        $signUpEmailNotification->send();

        // Act
        $isSent = $signUpEmailNotification->isSent();

        // Assert
        $this->assertTrue($isSent);
    }
}
