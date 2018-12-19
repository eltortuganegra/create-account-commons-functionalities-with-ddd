<?php

namespace cacf\infrastructure\repositories;

use cacf\models\Identifier;
use cacf\models\User;

interface UserRepository
{
    public function getNextIdentifier(): Identifier;
    public function add(User $user);
    public function find(Identifier $identifier): User;

}