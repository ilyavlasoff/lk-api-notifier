<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class CreatedDiscussionMessage implements IRoutable, IFcmSendable
{
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
    private $authorId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $authorName;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $authorSurname;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $authorPatronymic;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $textContent;

    /**
     * @var string | null
     * @JMS\Type("string")
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

    public function getRoutingKey(): string
    {
        return "{$this->group}.{$this->discipline}.{$this->semester}";
    }

    public function getExchangeName(): string
    {
        return 'discussion_msg';
    }

    public function getFcmNotificationBody(): string
    {
        $shortMessage = substr($this->textContent, 0, 100);
        if(strlen($shortMessage) < strlen($this->textContent)) {
            $shortMessage .= '...';
        }
        return "{$this->authorName} {$this->authorSurname}: $shortMessage";
    }

    public function getFcmNotificationTitle(): string
    {
        return 'Новое сообщение в обсуждении';
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
    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    /**
     * @param string|null $authorId
     */
    public function setAuthorId(?string $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     */
    public function setAuthorName(?string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string|null
     */
    public function getAuthorSurname(): ?string
    {
        return $this->authorSurname;
    }

    /**
     * @param string|null $authorSurname
     */
    public function setAuthorSurname(?string $authorSurname): void
    {
        $this->authorSurname = $authorSurname;
    }

    /**
     * @return string|null
     */
    public function getAuthorPatronymic(): ?string
    {
        return $this->authorPatronymic;
    }

    /**
     * @param string|null $authorPatronymic
     */
    public function setAuthorPatronymic(?string $authorPatronymic): void
    {
        $this->authorPatronymic = $authorPatronymic;
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
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     */
    public function setCreatedAt(?string $createdAt): void
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