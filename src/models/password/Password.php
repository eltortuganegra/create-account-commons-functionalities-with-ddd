<?php


namespace cacf\models\password;


interface Password
{
    public function verify(string $password): bool;
    public function getHash(): string;
}