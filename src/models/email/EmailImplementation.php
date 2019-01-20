<?php


namespace cacf\models\email;


class EmailImplementation implements Email
{
    private $emailText;

    public function __construct(string $emailText)
    {
        if ($this->isEmailValid($emailText)) {
            throw new EmailIsNotValidException();
        }

        $this->setEmailText($emailText);
    }

    private function isEmailValid(string $emailText): bool
    {
        return !filter_var($emailText, FILTER_VALIDATE_EMAIL);
    }

    private function setEmailText($emailText)
    {
        $this->emailText = $emailText;
    }

    public function getEmailText(): string
    {
        return $this->emailText;
    }

}