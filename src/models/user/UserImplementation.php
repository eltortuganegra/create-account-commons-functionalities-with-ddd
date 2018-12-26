<?php

namespace cacf\models\user;

use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\password\Password;

class UserImplementation implements User
{
    private $identifier;
    private $email;
    private $password;
    private $accountConfirmationCode;

    public function __construct(
        Identifier $identifier,
        Email $email,
        Password $password,
        AccountConfirmationCode $accountConfirmationCode
    ) {
        $this->setIdentifier($identifier);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setAccountConfirmationCode($accountConfirmationCode);
    }

    private function setIdentifier(Identifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }

    private function setEmail(Email $email)
    {
        $this->email = $email;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    private function setPassword(Password $password)
    {
        $this->password = $password;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    private function setAccountConfirmationCode(AccountConfirmationCode $accountConfirmationCode)
    {
        $this->accountConfirmationCode = $accountConfirmationCode;
    }

    public function getAccountConfirmationCode(): AccountConfirmationCode
    {
        return $this->accountConfirmationCode;
    }

    public function confirmAccount()
    {
        $this->accountConfirmationCode = null;
    }

    public function isAccountConfirmed()
    {
        return $this->accountConfirmationCode == null;
    }
}