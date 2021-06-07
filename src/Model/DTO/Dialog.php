<?php

namespace App\Model\DTO;

class Dialog
{
    /**
     * @var string | null
     */
    private $id;

    /**
     * @var Person | null
     */
    private $companion;

    /**
     * @var bool | null
     */
    private $hasUnread;

    /**
     * @var int | null
     */
    private $unreadCount;

    /**
     * @var PrivateMessage | null
     */
    private $lastMessage;

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
     * @return Person|null
     */
    public function getCompanion(): ?Person
    {
        return $this->companion;
    }

    /**
     * @param Person|null $companion
     */
    public function setCompanion(?Person $companion): void
    {
        $this->companion = $companion;
    }

    /**
     * @return bool|null
     */
    public function getHasUnread(): ?bool
    {
        return $this->hasUnread;
    }

    /**
     * @param bool|null $hasUnread
     */
    public function setHasUnread(?bool $hasUnread): void
    {
        $this->hasUnread = $hasUnread;
    }

    /**
     * @return int|null
     */
    public function getUnreadCount(): ?int
    {
        return $this->unreadCount;
    }

    /**
     * @param int|null $unreadCount
     */
    public function setUnreadCount(?int $unreadCount): void
    {
        $this->unreadCount = $unreadCount;
    }

    /**
     * @return PrivateMessage|null
     */
    public function getLastMessage(): ?PrivateMessage
    {
        return $this->lastMessage;
    }

    /**
     * @param PrivateMessage|null $lastMessage
     */
    public function setLastMessage(?PrivateMessage $lastMessage): void
    {
        $this->lastMessage = $lastMessage;
    }

}