<?php

namespace App\Model\Query;

use JMS\Serializer\Annotation as JMS;

class DialogCreateQueryParam
{
    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member1Id;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member2Id;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member1Name;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member1Surname;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member1Patronymic;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member2Name;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member2Surname;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $member2Patronymic;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $dialogId;

    /**
     * @var int | null
     * @JMS\Type("int")
     */
    private $unread1Count;

    /**
     * @var int | null
     * @JMS\Type("int")
     */
    private $unread2Count;

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

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $lastAuthor;

    /**
     * @var \DateTime
     * @JMS\Type("DateTime<'y-m-d H:i:s'>")
     */
    private $lastSendTime;

    /**
     * @return string|null
     */
    public function getMember1Id(): ?string
    {
        return $this->member1Id;
    }

    /**
     * @return \DateTime
     */
    public function getLastSendTime(): \DateTime
    {
        return $this->lastSendTime;
    }

    /**
     * @param \DateTime $lastSendTime
     */
    public function setLastSendTime(\DateTime $lastSendTime): void
    {
        $this->lastSendTime = $lastSendTime;
    }

    /**
     * @param string|null $member1Id
     */
    public function setMember1Id(?string $member1Id): void
    {
        $this->member1Id = $member1Id;
    }

    /**
     * @return string|null
     */
    public function getMember2Id(): ?string
    {
        return $this->member2Id;
    }

    /**
     * @param string|null $member2Id
     */
    public function setMember2Id(?string $member2Id): void
    {
        $this->member2Id = $member2Id;
    }

    /**
     * @return string|null
     */
    public function getMember1Name(): ?string
    {
        return $this->member1Name;
    }

    /**
     * @param string|null $member1Name
     */
    public function setMember1Name(?string $member1Name): void
    {
        $this->member1Name = $member1Name;
    }

    /**
     * @return string|null
     */
    public function getMember1Surname(): ?string
    {
        return $this->member1Surname;
    }

    /**
     * @param string|null $member1Surname
     */
    public function setMember1Surname(?string $member1Surname): void
    {
        $this->member1Surname = $member1Surname;
    }

    /**
     * @return string|null
     */
    public function getMember1Patronymic(): ?string
    {
        return $this->member1Patronymic;
    }

    /**
     * @param string|null $member1Patronymic
     */
    public function setMember1Patronymic(?string $member1Patronymic): void
    {
        $this->member1Patronymic = $member1Patronymic;
    }

    /**
     * @return string|null
     */
    public function getMember2Name(): ?string
    {
        return $this->member2Name;
    }

    /**
     * @param string|null $member2Name
     */
    public function setMember2Name(?string $member2Name): void
    {
        $this->member2Name = $member2Name;
    }

    /**
     * @return string|null
     */
    public function getMember2Surname(): ?string
    {
        return $this->member2Surname;
    }

    /**
     * @param string|null $member2Surname
     */
    public function setMember2Surname(?string $member2Surname): void
    {
        $this->member2Surname = $member2Surname;
    }

    /**
     * @return string|null
     */
    public function getMember2Patronymic(): ?string
    {
        return $this->member2Patronymic;
    }

    /**
     * @param string|null $member2Patronymic
     */
    public function setMember2Patronymic(?string $member2Patronymic): void
    {
        $this->member2Patronymic = $member2Patronymic;
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
     * @return int|null
     */
    public function getUnread1Count(): ?int
    {
        return $this->unread1Count;
    }

    /**
     * @param int|null $unread1Count
     */
    public function setUnread1Count(?int $unread1Count): void
    {
        $this->unread1Count = $unread1Count;
    }

    /**
     * @return int|null
     */
    public function getUnread2Count(): ?int
    {
        return $this->unread2Count;
    }

    /**
     * @param int|null $unread2Count
     */
    public function setUnread2Count(?int $unread2Count): void
    {
        $this->unread2Count = $unread2Count;
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
    public function getLastAuthor(): ?string
    {
        return $this->lastAuthor;
    }

    /**
     * @param string|null $lastAuthor
     */
    public function setLastAuthor(?string $lastAuthor): void
    {
        $this->lastAuthor = $lastAuthor;
    }

}