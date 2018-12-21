<?php

namespace cacf\infrastructure\emailNotifications;


use cacf\models\email\Email;

interface EmailNotification
{
    public function send(Email $toEmail, Email $fromEmail, string $subject, string $body);
    public function isSent():bool;
}