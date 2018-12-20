<?php

namespace cacf\infrastructure\emailNotifications\fakeEmailNotification;

use cacf\infrastructure\emailNotifications\EmailNotification;
use cacf\models\email\Email;

class FakeEmailNotification implements EmailNotification
{
    private $email;
    private $subject;
    private $body;
    private $headers;
    private $isSent;

    public function __construct(Email $email, string $subject, string $body, string $headers)
    {
        $this->setEmail($email);
        $this->setSubject($subject);
        $this->setBody($body);
        $this->setHeaders($headers);
        $this->setIsSent(false);
    }

    private function setEmail(Email $email)
    {
        $this->email = $email;
    }

    private function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    private function setBody(string $body)
    {
        $this->body = $body;
    }

    private function setHeaders(string $headers)
    {
        $this->headers = $headers;
    }

    public function send()
    {
        $this->isSent(true);
    }

    private function setIsSent()
    {
        $this->isSent = true;
    }

    public function isSent(): bool
    {
        return $this->isSent;
    }
}