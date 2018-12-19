<?php

namespace cacf\infrastructure\repositories;


use cacf\models\identifier\Identifier;
use cacf\models\user\User;

interface UserRepository
{
    public function getNextIdentifier(): Identifier;
    public function add(User $user);
    public function find(Identifier $identifier): User;

}