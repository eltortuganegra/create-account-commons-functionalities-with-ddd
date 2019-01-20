<?php

namespace tests\fixtures;

use cacf\infrastructure\repositories\UserRepository;
use tests\fixtures\user\LeChuckFixtureUserFactory;

class AddLeChuckToRepository
{
    private $userRepository;
    private $leChuckUser;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        $this->createLeChuckUser();
        $this->addLeChuckToUserRepository();
    }

    private function createLeChuckUser(): void
    {
        $leChuckFixtureUserFactory = new LeChuckFixtureUserFactory();
        $this->leChuckUser = $leChuckFixtureUserFactory->create();
    }

    private function addLeChuckToUserRepository(): void
    {
        $this->userRepository->add($this->leChuckUser);
    }

}