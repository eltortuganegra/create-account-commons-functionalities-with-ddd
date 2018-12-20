<?php

namespace cacf\infrastructure\emailNotifications\fakeEmailNotification;


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\models\email\Email;

class FakeEmailNotificationFactory
{
    public function create(Email $email, string $subject, string $body, string $headers): EmailNotification
    {
        return new FakeEmailNotification($email, $subject, $body, $headers);
    }

}