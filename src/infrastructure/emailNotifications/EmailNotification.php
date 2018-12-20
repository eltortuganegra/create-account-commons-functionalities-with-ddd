<?php

namespace cacf\infrastructure\emailNotifications;


interface EmailNotification
{
    public function send();
    public function isSent():bool;
}