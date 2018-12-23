<?php

namespace cacf\models\user;


use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\password\Password;

interface User
{
    public function setIdentifier(Identifier $identifier);
    public function getIdentifier(): Identifier;
    public function setEmail(Email $email);
    public function getEmail(): Email;
    public function setPassword(Password $password);
    public function getPassword(): Password;
    public function confirmAccount();
}