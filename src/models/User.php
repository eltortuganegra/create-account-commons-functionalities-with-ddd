<?php

namespace cacf\models;


interface User
{
    public function setIdentifier(Identifier $identifier);
    public function getIdentifier(): Identifier;
    public function setEmail(Email $email);
    public function getEmail(): Email;
    public function setPassword(Password $password);
    public function getPassword(): Password;
}