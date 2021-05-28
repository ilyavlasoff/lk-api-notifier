<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserDevices
 * @package App\Entity
 * @ORM\Entity()
 */
class UserDevices
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Receiver", inversedBy="devices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string", length=4096, nullable=false)
     */
    private $fcmKey;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFcmKey(): ?string
    {
        return $this->fcmKey;
    }

    public function setFcmKey(string $fcmKey): self
    {
        $this->fcmKey = $fcmKey;

        return $this;
    }

    public function getUser(): ?Receiver
    {
        return $this->user;
    }

    public function setUser(?Receiver $user): self
    {
        $this->user = $user;

        return $this;
    }
}