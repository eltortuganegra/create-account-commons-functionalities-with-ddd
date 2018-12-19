<?php

namespace cacf\services\signUp;


use cacf\services\ServiceResponse;

class SignUpServiceResponseFactory
{
    public function create(): ServiceResponse
    {
        return new SignUpServiceResponse();
    }

}