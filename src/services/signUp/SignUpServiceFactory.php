<?php

namespace cacf\services\signUp;

class SignUpServiceFactory
{
    public function create()
    {
        return new SignUpService();
    }

}