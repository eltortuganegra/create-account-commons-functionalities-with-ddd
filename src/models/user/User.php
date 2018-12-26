<?php

namespace cacf\models\user;


use cacf\models\email\Email;
use cacf\models\recoveryPasswordCode\recoveryPasswordCode;

interface User
{
    public function confirmAccount();
    public function getEmail(): Email;
    public function recoveryPassword(RecoveryPasswordCode $recoveryPasswordCode);
}