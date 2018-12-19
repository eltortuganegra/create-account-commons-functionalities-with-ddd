<?php

namespace cacf\models;

interface User
{
    public function setIdentifier(Identifier $identifier);
    public function getIdentifier(): Identifier;

}