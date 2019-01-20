<?php


namespace cacf\services\login;


use cacf\services\ServiceResponse;

class LoginServiceResponse implements ServiceResponse
{
    private $identifier;
    private $email;
    private $areCredentialValid;

    public function __construct(bool $areCredentialValid, string $identifier, string $email)
    {
        $this->identifier = $identifier;
        $this->email = $email;
        $this->areCredentialValid = $areCredentialValid;
    }

    public function areCredentialsValid(): bool
    {
        return $this->areCredentialValid;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}