<?php

namespace cacf\infrastructure\repositories;

use cacf\models\identifier\IdentifierFactory;

class UserRepositoryInMemoryFactory
{
    public function create(): UserRepository
    {
        $identifierFactory = new IdentifierFactory();

        return new UserRepositoryInMemoryImplementation($identifierFactory);
    }
}