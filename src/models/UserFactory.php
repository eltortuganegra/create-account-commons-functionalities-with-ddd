<?php


namespace cacf\models;


class UserFactory
{
    public function create(): User
    {
        return new UserImplementation();
    }

}