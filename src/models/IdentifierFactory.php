<?php


namespace cacf\models;


class IdentifierFactory
{
    public function create(string $value): Identifier
    {
        return new IdentifierImplementation($value);
    }

}