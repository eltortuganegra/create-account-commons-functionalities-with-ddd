<?php


namespace cacf\models\password;


class BcryptPasswordImplementation implements Password
{
    private $text;

    public function __construct(string $text)
    {
        $this->encryptPasswordText($text);
    }

    private function encryptPasswordText(string $text): void
    {
        $passwordHash = password_hash($text, PASSWORD_BCRYPT);
        $this->setText($passwordHash);
    }

    private function setText(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

}