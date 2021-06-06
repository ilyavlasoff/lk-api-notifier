<?php

namespace App\Service;

use RedjanYm\FCMBundle\FCMClient;

class FcmService
{
    /**
     * @var FCMClient
     */
    private $fcmClient;

    public function __construct(FCMClient $FCMClient)
    {
        $this->fcmClient = $FCMClient;
    }

    /**
     * @param string $notificationTitle
     * @param string $notificationBody
     * @param string $deviceId
     */
    public function sendWithDeviceId(string $notificationTitle, string $notificationBody, string $deviceId) {
        $notification = $this->fcmClient->createDeviceNotification();
        $notification->setTitle($notificationTitle);
        $notification->setBody($notificationBody);
        $notification->setDeviceToken($deviceId);

        $this->fcmClient->sendNotification($notification);
    }
}