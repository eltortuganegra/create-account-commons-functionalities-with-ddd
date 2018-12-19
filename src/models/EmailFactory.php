<?php


namespace cacf\models;


class EmailFactory
{

    public function create(string $emailText): Email
    {
        return new EmailImplementation($emailText);
    }

}