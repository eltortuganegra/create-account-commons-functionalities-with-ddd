<?php


namespace cacf\models;


class PasswordFactory
{
    public function create(string $passwordText): Password
    {
        return new BcryptPasswordImplementation($passwordText);
    }
}