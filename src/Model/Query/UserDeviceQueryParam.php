<?php

namespace App\Model\Query;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class UserDeviceQueryParam
{
    /**
     * @var string | null
     * @JMS\Type("string")
     * @Assert\NotNull(message="User field can not be nullable")
     */
    private $user;

    /**
     * @var string | null
     * @JMS\Type("string")
     * @Assert\NotNull(message="Fcm key field can not be nullable")
     */
    private $fcmKey;

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @param string|null $user
     */
    public function setUser(?string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string|null
     */
    public function getFcmKey(): ?string
    {
        return $this->fcmKey;
    }

    /**
     * @param string|null $fcmKey
     */
    public function setFcmKey(?string $fcmKey): void
    {
        $this->fcmKey = $fcmKey;
    }

}