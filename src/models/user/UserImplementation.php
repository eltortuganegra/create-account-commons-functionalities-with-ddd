<?php

namespace cacf\models\user;

use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\password\Password;

class UserImplementation implements User
{
    private $identifier;
    private $email;
    private $password;

    public function setIdentifier(Identifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }

    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setPassword(Password $password)
    {
        $this->password = $password;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }
}