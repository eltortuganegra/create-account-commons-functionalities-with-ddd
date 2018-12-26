<?php

namespace cacf\infrastructure\repositories;



use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\recoveryPasswordCode\recoveryPasswordCode;
use cacf\models\user\User;

interface UserRepository
{
    public function getNextIdentifier(): Identifier;
    public function add(User $user);
    public function find(Identifier $identifier): User;
    public function findByAccountConfirmationCode(AccountConfirmationCode $accountConfirmationCodeCode): User;
    public function findByRecoveryPasswordCode(RecoveryPasswordCode $recoveryPasswordCode): User;
    public function findByEmail(Email $email);
    public function update(User $user);
}