<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class CreatedDialog implements IRoutable
{
    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $creatorId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $receiverId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $dialogId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $companionName;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $companionSurname;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $companionPatronymic;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $lastMessageId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $lastMessageText;

    public function getRoutingKey(): string
    {
        return $this->receiverId;
    }

    public function getExchangeName(): string
    {
        return 'dialog';
    }

    /**
     * @return string|null
     */
    public function getReceiverId(): ?string
    {
        return $this->receiverId;
    }

    /**
     * @param string|null $receiverId
     */
    public function setReceiverId(?string $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    /**
     * @return string|null
     */
    public function getDialogId(): ?string
    {
        return $this->dialogId;
    }

    /**
     * @param string|null $dialogId
     */
    public function setDialogId(?string $dialogId): void
    {
        $this->dialogId = $dialogId;
    }

    /**
     * @return string|null
     */
    public function getCompanionName(): ?string
    {
        return $this->companionName;
    }

    /**
     * @param string|null $companionName
     */
    public function setCompanionName(?string $companionName): void
    {
        $this->companionName = $companionName;
    }

    /**
     * @return string|null
     */
    public function getCompanionSurname(): ?string
    {
        return $this->companionSurname;
    }

    /**
     * @param string|null $companionSurname
     */
    public function setCompanionSurname(?string $companionSurname): void
    {
        $this->companionSurname = $companionSurname;
    }

    /**
     * @return string|null
     */
    public function getCompanionPatronymic(): ?string
    {
        return $this->companionPatronymic;
    }

    /**
     * @param string|null $companionPatronymic
     */
    public function setCompanionPatronymic(?string $companionPatronymic): void
    {
        $this->companionPatronymic = $companionPatronymic;
    }

    /**
     * @return string|null
     */
    public function getLastMessageId(): ?string
    {
        return $this->lastMessageId;
    }

    /**
     * @param string|null $lastMessageId
     */
    public function setLastMessageId(?string $lastMessageId): void
    {
        $this->lastMessageId = $lastMessageId;
    }

    /**
     * @return string|null
     */
    public function getLastMessageText(): ?string
    {
        return $this->lastMessageText;
    }

    /**
     * @param string|null $lastMessageText
     */
    public function setLastMessageText(?string $lastMessageText): void
    {
        $this->lastMessageText = $lastMessageText;
    }

    /**
     * @return string|null
     */
    public function getCreatorId(): ?string
    {
        return $this->creatorId;
    }

    /**
     * @param string|null $creatorId
     */
    public function setCreatorId(?string $creatorId): void
    {
        $this->creatorId = $creatorId;
    }

}