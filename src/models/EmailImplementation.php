<?php


namespace cacf\models;


class EmailImplementation implements Email
{
    private $emailText;

    public function __construct(string $emailText)
    {
        if ( ! filter_var($emailText, FILTER_VALIDATE_EMAIL)) {
            throw new EmailIsNotValidException();
        }
    }

    public function getValue(): string
    {
        return $this->emailText;
    }
}