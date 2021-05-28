<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class CreatedPrivateMessage implements IRoutable, IFcmSendable
{
    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $messageId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $senderCompanion;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $dialogId;

    /**
     * @var string | null
     * @JMS\Type("string")
     */
    private $textContent;

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
     * @var string | null
     * @JMS\Type("string")
     */
    private $messageNumber;

    public function getRoutingKey(): string
    {
        return $this->dialogId;
    }

    public function getExchangeName(): string
    {
        return 'private_msg';
    }

    public function getFcmNotificationTitle(): string
    {
        return "$this->authorName $this->authorSurname";
    }

    public function getFcmNotificationBody(): string
    {
        $shortMessage = substr($this->textContent, 0, 100);
        if(strlen($shortMessage) < strlen($this->textContent)) {
            $shortMessage .= '...';
        }
        return $shortMessage;
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

    /**
     * @return string|null
     */
    public function getMessageNumber(): ?string
    {
        return $this->messageNumber;
    }

    /**
     * @param string|null $messageNumber
     */
    public function setMessageNumber(?string $messageNumber): void
    {
        $this->messageNumber = $messageNumber;
    }

    /**
     * @return string|null
     */
    public function getSenderCompanion(): ?string
    {
        return $this->senderCompanion;
    }

    /**
     * @param string|null $senderCompanion
     */
    public function setSenderCompanion(?string $senderCompanion): void
    {
        $this->senderCompanion = $senderCompanion;
    }

}