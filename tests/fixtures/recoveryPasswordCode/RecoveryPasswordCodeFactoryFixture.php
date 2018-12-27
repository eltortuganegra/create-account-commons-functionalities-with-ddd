<?php

namespace tests\fixtures\recoveryPasswordCode;

use cacf\models\recoveryPasswordCode\RecoveryPasswordCodeFactory;

class RecoveryPasswordCodeFactoryFixture
{
    const DEFAULT_CODE = '1d656b9a-ba35-4968-8b12-8eb9b3cb2a56';

    public function createDefault()
    {
        $recoveryPasswordCodeFactory = new RecoveryPasswordCodeFactory();
        $recoveryPasswordCode = $recoveryPasswordCodeFactory->create(self::DEFAULT_CODE);

        return $recoveryPasswordCode;
    }
}