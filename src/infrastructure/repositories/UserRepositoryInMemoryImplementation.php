<?php

namespace cacf\infrastructure\repositories;

use AccountConfirmCode;
use cacf\models\accountConfirmationCode\AccountConfirmationCode;
use cacf\models\email\Email;
use cacf\models\identifier\Identifier;
use cacf\models\identifier\IdentifierFactory;
use cacf\models\recoveryPasswordCode\recoveryPasswordCode;
use cacf\models\user\User;
use Ramsey\Uuid\Uuid;

class UserRepositoryInMemoryImplementation implements UserRepository
{
    private $users;
    private $usersByAccountConfirmationCode;
    private $usersByEmail;
    private $usersByRecoveryPasswordCode;
    private $identifierFactory;

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

        $key = $user->getEmail()->getEmailText();
        $this->usersByEmail[$key] = $user;
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

        $key = $user->getEmail()->getEmailText();
        $this->usersByEmail[$key] = $user;

        $recoveryPasswordCode = $user->getRecoveryPasswordCode();
        if ( ! empty($recoveryPasswordCode)) {
            $key = $recoveryPasswordCode->getCode();
            if ( ! empty($key)) {
                $this->usersByRecoveryPasswordCode[$key] = $user;
            }
        } else {
            $key = array_search($user, $this->usersByRecoveryPasswordCode);
            if ( ! empty($key)) {
                unset($this->usersByRecoveryPasswordCode[$key]);
            }
        }
    }

    public function findByAccountConfirmationCode(AccountConfirmationCode $accountConfirmationCodeCode): User
    {
        $key = $accountConfirmationCodeCode->getCode();

        return $this->usersByAccountConfirmationCode[$key];
    }

    public function findByEmail(Email $email)
    {
        $key = $email->getEmailText();
        if ( ! isset($this->usersByEmail[$key])) {
            throw new UserNotFoundException();
        }

        return $this->usersByEmail[$key];
    }

    public function findByRecoveryPasswordCode(RecoveryPasswordCode $recoveryPasswordCode): ?User
    {
        $key = $recoveryPasswordCode->getCode();

        if ( ! array_key_exists($key, $this->usersByRecoveryPasswordCode)) {
            return null;
        }

        return $this->usersByRecoveryPasswordCode[$key];
    }
}