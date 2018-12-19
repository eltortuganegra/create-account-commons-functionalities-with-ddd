<?php

namespace cacf\services;

interface Service
{
    public function execute(ServiceRequest $serviceRequest): ServiceResponse;

}