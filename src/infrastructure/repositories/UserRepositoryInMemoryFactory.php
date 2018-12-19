<?php

namespace cacf\infrastructure\repositories;

use cacf\models\IdentifierFactory;

class UserRepositoryInMemoryFactory
{
    public function create(): UserRepository
    {
        $identifierFactory = new IdentifierFactory();

        return new UserRepositoryInMemoryImplementation($identifierFactory);
    }
}