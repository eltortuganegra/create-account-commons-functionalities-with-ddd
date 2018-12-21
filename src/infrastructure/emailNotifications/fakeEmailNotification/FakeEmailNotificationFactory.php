<?php

namespace cacf\infrastructure\emailNotifications\fakeEmailNotification;


use cacf\infrastructure\emailNotifications\EmailNotification;

class FakeEmailNotificationFactory
{
    public function create(): EmailNotification
    {
        return new FakeEmailNotification();
    }

}