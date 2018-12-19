<?php


namespace cacf\models\password;


class PasswordFactory
{
    public function create(string $passwordText): Password
    {
        return new BcryptPasswordImplementation($passwordText);
    }
}