<?php


namespace cacf\infrastructure\emailNotifications\recoveryPasswordEmailNotification;


use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\models\email\Email;

class RecoveryPasswordEmailNotification implements EmailNotification
{

    public function send(Email $toEmail, Email $fromEmail, string $subject, string $body)
    {
        // TODO: Implement send() method.
    }

    public function isSent(): bool
    {
        // TODO: Implement isSent() method.
    }
}