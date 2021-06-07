<?php

namespace App\Model\Query;

use JMS\Serializer\Annotation as JMS;

class DiscussionMessageQueryParam
{
    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $id;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $group;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $discipline;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $semester;

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
     * @JMS\Type("DateTime<'y-m-d H:i:s'>")
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
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string|null $group
     */
    public function setGroup(?string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string|null
     */
    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    /**
     * @param string|null $discipline
     */
    public function setDiscipline(?string $discipline): void
    {
        $this->discipline = $discipline;
    }

    /**
     * @return string|null
     */
    public function getSemester(): ?string
    {
        return $this->semester;
    }

    /**
     * @param string|null $semester
     */
    public function setSemester(?string $semester): void
    {
        $this->semester = $semester;
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

}