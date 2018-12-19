<?php

namespace cacf\infrastructure\repositories;

use cacf\models\Identifier;
use cacf\models\IdentifierFactory;
use cacf\models\User;

class UserRepositoryInMemoryImplementation implements UserRepository
{
    private $identifierFactory;
    private $users;

    public function __construct( IdentifierFactory $identifierFactory)
    {
        $this->identifierFactory = $identifierFactory;
    }

    public function getNextIdentifier(): Identifier
    {
        $value = rand(0,1000);
        $identifier = $this->identifierFactory->create($value);

        return $identifier;
    }

    public function add(User $user)
    {
        $key = $user->getIdentifier()->getValue();
        $this->users[$key] = $user;
    }

    public function find(Identifier $identifier): User
    {
        $key = $identifier->getValue();

        return $this->users[$key];
    }
}