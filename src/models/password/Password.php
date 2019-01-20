<?php


namespace cacf\models\password;


interface Password
{
    public function verify(string $plainTextPassword): bool;
    public function getHash(): string;
}