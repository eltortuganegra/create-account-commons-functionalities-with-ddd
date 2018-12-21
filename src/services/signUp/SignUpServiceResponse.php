<?php


namespace cacf\services\signUp;


use cacf\models\identifier\Identifier;
use cacf\services\ServiceResponse;

class SignUpServiceResponse implements ServiceResponse
{
    private $identifierValue;
    private $isWelcomeEmailNotificationSent;

    public function __construct(Identifier $identifier, bool $isWelcomeEmailNotificationSent)
    {
        $this->identifierValue = $identifier->getValue();
        $this->isWelcomeEmailNotificationSent = $isWelcomeEmailNotificationSent;
    }

    public function getIdentifierValue(): string
    {
        return $this->identifierValue;
    }

    public function isWelcomeEmailNotificationSent(): bool
    {
        return $this->isWelcomeEmailNotificationSent;
    }

}