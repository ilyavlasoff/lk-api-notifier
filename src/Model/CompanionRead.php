<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class CompanionRead implements IRoutable
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $dialog;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $person;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $lastReadMessage;

    public function getRoutingKey(): string
    {
        return "{$this->dialog}.{$this->person}";
    }

    public function getExchangeName(): string
    {
        return 'read-event';
    }

    /**
     * @return string
     */
    public function getDialog(): string
    {
        return $this->dialog;
    }

    /**
     * @param string $dialog
     */
    public function setDialog(string $dialog): void
    {
        $this->dialog = $dialog;
    }

    /**
     * @return string
     */
    public function getPerson(): string
    {
        return $this->person;
    }

    /**
     * @param string $person
     */
    public function setPerson(string $person): void
    {
        $this->person = $person;
    }

    /**
     * @return string
     */
    public function getLastReadMessage(): string
    {
        return $this->lastReadMessage;
    }

    /**
     * @param string $lastReadMessage
     */
    public function setLastReadMessage(string $lastReadMessage): void
    {
        $this->lastReadMessage = $lastReadMessage;
    }

}