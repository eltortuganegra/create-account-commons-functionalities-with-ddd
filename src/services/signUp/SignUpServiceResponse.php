<?php


namespace cacf\services\signUp;


use cacf\models\identifier\Identifier;
use cacf\services\ServiceResponse;

class SignUpServiceResponse implements ServiceResponse
{
    private $identifierValue;

    public function __construct(Identifier $identifier)
    {
        $this->setIdentifierValue($identifier->getValue());
    }

    private function setIdentifierValue(string $identifierValue)
    {
        $this->identifierValue = $identifierValue;
    }

    public function getIdentifierValue(): string
    {
        return $this->identifierValue;
    }

}