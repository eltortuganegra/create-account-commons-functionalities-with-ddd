<?php

namespace cacf\models\user;


class UserFactory
{
    public function create(): User
    {
        return new UserImplementation();
    }

}