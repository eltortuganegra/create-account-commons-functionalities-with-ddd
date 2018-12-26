<?php

namespace cacf\models\user;

use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\password\Password;
use cacf\models\recoveryPasswordCode\recoveryPasswordCode;

class UserImplementation implements User
{
    private $identifier;
    private $email;
    private $password;
    private $accountConfirmationCode;
    private $recoveryPasswordCode;

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

    public function recoveryPassword(RecoveryPasswordCode $recoveryPasswordCode)
    {
        $this->setRecoveryPasswordCode($recoveryPasswordCode);
    }

    private function setRecoveryPasswordCode(RecoveryPasswordCode $recoveryPasswordCode)
    {
        $this->recoveryPasswordCode = $recoveryPasswordCode;
    }

    public function getRecoveryPasswordCode(): RecoveryPasswordCode
    {
        return $this->recoveryPasswordCode;
    }
}