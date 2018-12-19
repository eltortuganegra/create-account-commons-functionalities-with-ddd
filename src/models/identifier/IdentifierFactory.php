<?php


namespace cacf\models\identifier;


class IdentifierFactory
{
    public function create(string $value): Identifier
    {
        return new IdentifierImplementation($value);
    }

}