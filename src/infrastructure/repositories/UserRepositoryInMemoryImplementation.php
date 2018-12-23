<?php

namespace cacf\infrastructure\repositories;

use AccountConfirmCode;
use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\identifier\Identifier;
use cacf\models\identifier\IdentifierFactory;
use cacf\models\user\User;
use Ramsey\Uuid\Uuid;

class UserRepositoryInMemoryImplementation implements UserRepository
{
    private $identifierFactory;
    private $users;
    private $usersByAccountConfirmationCode;

    public function __construct(IdentifierFactory $identifierFactory)
    {
        $this->identifierFactory = $identifierFactory;
    }

    public function getNextIdentifier(): Identifier
    {
        $value = Uuid::uuid4();
        $identifier = $this->identifierFactory->create($value);

        return $identifier;
    }

    public function add(User $user)
    {
        $key = $user->getIdentifier()->getValue();
        $this->users[$key] = $user;

        $key = $user->getAccountConfirmationCode()->getCode();
        $this->usersByAccountConfirmationCode[$key] = $user;

    }

    public function find(Identifier $identifier): User
    {
        $key = $identifier->getValue();

        return $this->users[$key];
    }

    public function update(User $user)
    {
        $key = $user->getIdentifier()->getValue();
        $this->users[$key] = $user;
    }

    public function findByAccountConfirmationCode(AccountConfirmationCode $accountConfirmationCodeCode): User
    {
        $key = $accountConfirmationCodeCode->getCode();

        return $this->usersByAccountConfirmationCode[$key];
    }
}