<?php


namespace cacf\models\email;


class EmailFactory
{

    public function create(string $emailText): Email
    {
        return new EmailImplementation($emailText);
    }

}