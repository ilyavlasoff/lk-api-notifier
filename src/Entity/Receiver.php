<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Receiver
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ReceiverRepository")
 */
class Receiver
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="string", length=2048)
     */
    private $id;

    /**
     * @var bool | null
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mutePrivateMessages;

    /**
     * @var bool | null
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $muteDiscussionMessages;

    /**
     * @var UserDevices[]
     * @ORM\OneToMany(targetEntity="UserDevices", mappedBy="user")
     */
    private $devices;

    public function __construct()
    {
        $this->devices = new ArrayCollection();
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMutePrivateMessages(): ?bool
    {
        return $this->mutePrivateMessages;
    }

    public function setMutePrivateMessages(bool $mutePrivateMessages): self
    {
        $this->mutePrivateMessages = $mutePrivateMessages;

        return $this;
    }

    public function getMuteDiscussionMessages(): ?bool
    {
        return $this->muteDiscussionMessages;
    }

    public function setMuteDiscussionMessages(bool $muteDiscussionMessages): self
    {
        $this->muteDiscussionMessages = $muteDiscussionMessages;

        return $this;
    }

    /**
     * @return Collection|UserDevices[]
     */
    public function getDevices(): Collection
    {
        return $this->devices;
    }

    public function addDevice(UserDevices $device): self
    {
        if (!$this->devices->contains($device)) {
            $this->devices[] = $device;
            $device->setUser($this);
        }

        return $this;
    }

    public function removeDevice(UserDevices $device): self
    {
        if ($this->devices->removeElement($device)) {
            // set the owning side to null (unless already changed)
            if ($device->getUser() === $this) {
                $device->setUser(null);
            }
        }

        return $this;
    }
}