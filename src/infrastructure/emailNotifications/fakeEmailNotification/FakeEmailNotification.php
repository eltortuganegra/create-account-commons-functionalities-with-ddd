<?php

namespace cacf\infrastructure\emailNotifications\fakeEmailNotification;

use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\models\email\Email;

class FakeEmailNotification implements EmailNotification
{
    private $isSent;

    public function __construct()
    {
        $this->setIsSent(false);
    }

    private function setIsSent()
    {
        $this->isSent = true;
    }

    public function isSent(): bool
    {
        return $this->isSent;
    }

    public function send(Email $toEmail, Email $fromEmail, string $subject, string $body)
    {
        $this->isSent(true);
    }

}