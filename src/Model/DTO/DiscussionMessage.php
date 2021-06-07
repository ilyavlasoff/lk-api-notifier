<?php

namespace App\Model\DTO;

class DiscussionMessage
{
    /**
     * @var string | null
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
     * @var Person | null
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
     * @var Attachment[] | null
     */
    private $attachments;

    /**
     * @var ExternalLink[] | null
     */
    private $externalLinks;

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

    /**
     * @return ExternalLink[]|null
     */
    public function getExternalLinks(): ?array
    {
        return $this->externalLinks;
    }

    /**
     * @param ExternalLink[]|null $externalLinks
     */
    public function setExternalLinks(?array $externalLinks): void
    {
        $this->externalLinks = $externalLinks;
    }

}