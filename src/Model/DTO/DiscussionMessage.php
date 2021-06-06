<?php

namespace App\Model\DTO;

class DiscussionMessage
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string | null
     */
    private $group;

    /**
     * @var string | null
     */
    private $discipline;

    /**
     * @var string | null
     */
    private $semester;

    /**
     * @var Person
     */
    private $sender;

    /**
     * @var \DateTime | null
     */
    private $created;

    /**
     * @var string | null
     */
    private $msg;

    /**
     * @var Attachment[]
     */
    private $attachments;

    /**
     * @var ExternalLink[]
     */
    private $externalLinks;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \App\Model\DTO\Person
     */
    public function getSender(): Person
    {
        return $this->sender;
    }

    /**
     * @param \App\Model\DTO\Person $sender
     */
    public function setSender(Person $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     */
    public function setCreated(?\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return string|null
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * @param string|null $msg
     */
    public function setMsg(?string $msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param Attachment[] $attachments
     */
    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    /**
     * @return ExternalLink[]
     */
    public function getExternalLinks(): array
    {
        return $this->externalLinks;
    }

    /**
     * @param ExternalLink[] $externalLinks
     */
    public function setExternalLinks(array $externalLinks): void
    {
        $this->externalLinks = $externalLinks;
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

}