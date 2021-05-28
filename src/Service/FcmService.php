<?php

namespace App\Service;

use App\Model\IFcmSendable;
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
     * @param IFcmSendable $message
     * @param string $deviceId
     */
    public function sendWithDeviceId(IFcmSendable $message, string $deviceId) {
        $notification = $this->fcmClient->createDeviceNotification();
        $notification->setTitle($message->getFcmNotificationTitle());
        $notification->setBody($message->getFcmNotificationBody());
        $notification->setDeviceToken($deviceId);

        $this->fcmClient->sendNotification($notification);
    }
}