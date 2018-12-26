<?php


namespace cacf\models\recoveryPasswordCode;


class RecoveryPasswordCodeImplementation implements RecoveryPasswordCode
{
    private $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode():string
    {
        return $this->code;
    }
}