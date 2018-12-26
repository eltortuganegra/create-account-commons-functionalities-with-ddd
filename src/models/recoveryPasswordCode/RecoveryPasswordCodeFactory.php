<?php


namespace cacf\models\recoveryPasswordCode;


use Ramsey\Uuid\Uuid;

class RecoveryPasswordCodeFactory
{
    public function create(string $code): RecoveryPasswordCode
    {
        return new RecoveryPasswordCodeImplementation($code);
    }

    public function random(): RecoveryPasswordCode
    {
        $code = Uuid::uuid4();

        return $this->create($code);
    }

}