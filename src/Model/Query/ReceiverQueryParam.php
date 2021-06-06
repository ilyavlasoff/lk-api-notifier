<?php

namespace App\Model\Query;
use App\Entity\Receiver;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class ReceiverQueryParam
{
    /**
     * @var string | null
     * @JMS\Type("string")
     * @Assert\NotNull(message="Receiver identifier can not be nullable")
     */
    private $id;

    /**
     * @var bool | null
     * @JMS\Type("bool")
     */
    private $mutePrivate;

    /**
     * @var bool | null
     * @JMS\Type("bool")
     */
    private $muteDiscussion;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool|null
     */
    public function getMutePrivate(): ?bool
    {
        return $this->mutePrivate;
    }

    /**
     * @param bool|null $mutePrivate
     */
    public function setMutePrivate(?bool $mutePrivate): void
    {
        $this->mutePrivate = $mutePrivate;
    }

    /**
     * @return bool|null
     */
    public function getMuteDiscussion(): ?bool
    {
        return $this->muteDiscussion;
    }

    /**
     * @param bool|null $muteDiscussion
     */
    public function setMuteDiscussion(?bool $muteDiscussion): void
    {
        $this->muteDiscussion = $muteDiscussion;
    }

}