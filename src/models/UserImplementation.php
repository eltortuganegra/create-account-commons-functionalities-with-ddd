<?php

namespace cacf\models;

class UserImplementation implements User
{
    private $identifier;

    public function setIdentifier(Identifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }
}