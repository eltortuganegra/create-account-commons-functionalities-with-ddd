<?php


namespace cacf\models\password;


class BcryptPasswordImplementation implements Password
{
    private $hash;

    public function __construct(string $text)
    {
        $this->encryptPasswordText($text);
    }

    private function encryptPasswordText(string $text): void
    {
        $this->hash = password_hash($text, PASSWORD_BCRYPT);
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->hash);
    }
}