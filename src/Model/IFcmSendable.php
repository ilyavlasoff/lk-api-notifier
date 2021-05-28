<?php

namespace App\Model;

interface IFcmSendable {
    public function getFcmNotificationTitle(): string;

    public function getFcmNotificationBody(): string;
}