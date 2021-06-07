<?php

namespace App\Model\DTO;

class PrivateMessage
{
    /**
     * @var string | null
     */
    private $id;

    /**
     * @var string | null
     */
    private $chat;

    /**
     * @var Person | null
     */
    private $sender;

    /**
     * @var bool | null
     */
    private $meSender;

    /**
     * @var string | null
     */
    private $messageText;

    /**
     * @var \DateTime | null
     */
    private $sendTime;

    /**
     * @var bool | null
     */
    private $isRead;

    /**
     * @var ExternalLink[] | null
     */
    private $links;

    /**
     * @var Attachment[] | null
     */
    private $attachments;

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
     * @return string|null
     */
    public function getChat(): ?string
    {
        return $this->chat;
    }

    /**
     * @param string|null $chat
     */
    public function setChat(?string $chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return Person|null
     */
    public function getSender(): ?Person
    {
        return $this->sender;
    }

    /**
     * @param Person|null $sender
     */
    public function setSender(?Person $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return bool|null
     */
    public function getMeSender(): ?bool
    {
        return $this->meSender;
    }

    /**
     * @param bool|null $meSender
     */
    public function setMeSender(?bool $meSender): void
    {
        $this->meSender = $meSender;
    }

    /**
     * @return string|null
     */
    public function getMessageText(): ?string
    {
        return $this->messageText;
    }

    /**
     * @param string|null $messageText
     */
    public function setMessageText(?string $messageText): void
    {
        $this->messageText = $messageText;
    }

    /**
     * @return \DateTime|null
     */
    public function getSendTime(): ?\DateTime
    {
        return $this->sendTime;
    }

    /**
     * @param \DateTime|null $sendTime
     */
    public function setSendTime(?\DateTime $sendTime): void
    {
        $this->sendTime = $sendTime;
    }

    /**
     * @return bool|null
     */
    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    /**
     * @param bool|null $isRead
     */
    public function setIsRead(?bool $isRead): void
    {
        $this->isRead = $isRead;
    }

    /**
     * @return ExternalLink[]|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @param ExternalLink[]|null $links
     */
    public function setLinks(?array $links): void
    {
        $this->links = $links;
    }

    /**
     * @return Attachment[]|null
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     * @param Attachment[]|null $attachments
     */
    public function setAttachments(?array $attachments): void
    {
        $this->attachments = $attachments;
    }

}