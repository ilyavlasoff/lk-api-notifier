<?php

namespace App\Model\Query;

use JMS\Serializer\Annotation as JMS;

class PrivateMessageQueryParam
{
    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $dialog;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member1;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member2;

    /**
     * @var bool | null
     * @JMS\Type("bool")
     */
    private $member1Read;

    /**
     * @var bool | null
     * @JMS\Type("bool")
     */
    private $member2Read;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $messageId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $senderId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $senderName;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $senderSurname;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $senderPatronymic;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $textContent;

    /**
     * @var \DateTime
     * @JMS\Type("datetime")
     */
    private $createdAt;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $docName;

    /**
     * @var float | null
     * @JMS\Type("float")
     */
    private $docSize;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $linkText;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $linkContent;

    /**
     * @var int | null
     * @JMS\Type("int")
     */
    private $messageNumber;

    /**
     * @return string|null
     */
    public function getDialog(): ?string
    {
        return $this->dialog;
    }

    /**
     * @param string|null $dialog
     */
    public function setDialog(?string $dialog): void
    {
        $this->dialog = $dialog;
    }

    /**
     * @return bool|null
     */
    public function getMember1Read(): ?bool
    {
        return $this->member1Read;
    }

    /**
     * @param bool|null $member1Read
     */
    public function setMember1Read(?bool $member1Read): void
    {
        $this->member1Read = $member1Read;
    }

    /**
     * @return bool|null
     */
    public function getMember2Read(): ?bool
    {
        return $this->member2Read;
    }

    /**
     * @param bool|null $member2Read
     */
    public function setMember2Read(?bool $member2Read): void
    {
        $this->member2Read = $member2Read;
    }

    /**
     * @return string|null
     */
    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    /**
     * @param string|null $messageId
     */
    public function setMessageId(?string $messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * @return string|null
     */
    public function getSenderId(): ?string
    {
        return $this->senderId;
    }

    /**
     * @param string|null $senderId
     */
    public function setSenderId(?string $senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * @return string|null
     */
    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    /**
     * @param string|null $senderName
     */
    public function setSenderName(?string $senderName): void
    {
        $this->senderName = $senderName;
    }

    /**
     * @return string|null
     */
    public function getSenderSurname(): ?string
    {
        return $this->senderSurname;
    }

    /**
     * @param string|null $senderSurname
     */
    public function setSenderSurname(?string $senderSurname): void
    {
        $this->senderSurname = $senderSurname;
    }

    /**
     * @return string|null
     */
    public function getSenderPatronymic(): ?string
    {
        return $this->senderPatronymic;
    }

    /**
     * @param string|null $senderPatronymic
     */
    public function setSenderPatronymic(?string $senderPatronymic): void
    {
        $this->senderPatronymic = $senderPatronymic;
    }

    /**
     * @return string|null
     */
    public function getTextContent(): ?string
    {
        return $this->textContent;
    }

    /**
     * @param string|null $textContent
     */
    public function setTextContent(?string $textContent): void
    {
        $this->textContent = $textContent;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getDocName(): ?string
    {
        return $this->docName;
    }

    /**
     * @param string|null $docName
     */
    public function setDocName(?string $docName): void
    {
        $this->docName = $docName;
    }

    /**
     * @return float|null
     */
    public function getDocSize(): ?float
    {
        return $this->docSize;
    }

    /**
     * @param float|null $docSize
     */
    public function setDocSize(?float $docSize): void
    {
        $this->docSize = $docSize;
    }

    /**
     * @return string|null
     */
    public function getLinkText(): ?string
    {
        return $this->linkText;
    }

    /**
     * @param string|null $linkText
     */
    public function setLinkText(?string $linkText): void
    {
        $this->linkText = $linkText;
    }

    /**
     * @return string|null
     */
    public function getLinkContent(): ?string
    {
        return $this->linkContent;
    }

    /**
     * @param string|null $linkContent
     */
    public function setLinkContent(?string $linkContent): void
    {
        $this->linkContent = $linkContent;
    }

    /**
     * @return int|null
     */
    public function getMessageNumber(): ?int
    {
        return $this->messageNumber;
    }

    /**
     * @param int|null $messageNumber
     */
    public function setMessageNumber(?int $messageNumber): void
    {
        $this->messageNumber = $messageNumber;
    }

    /**
     * @return string|null
     */
    public function getMember1(): ?string
    {
        return $this->member1;
    }

    /**
     * @param string|null $member1
     */
    public function setMember1(?string $member1): void
    {
        $this->member1 = $member1;
    }

    /**
     * @return string|null
     */
    public function getMember2(): ?string
    {
        return $this->member2;
    }

    /**
     * @param string|null $member2
     */
    public function setMember2(?string $member2): void
    {
        $this->member2 = $member2;
    }

}