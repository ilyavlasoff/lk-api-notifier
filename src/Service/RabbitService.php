<?php

namespace App\Service;

use JMS\Serializer\SerializerInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RabbitService
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;
    /**
     * @var AMQPChannel
     */
    private $channel;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(ParameterBagInterface $parameterBag, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $host = $parameterBag->get('rabbit-host');
        $port = $parameterBag->get('rabbit-port');
        $username = $parameterBag->get('rabbit-user');
        $password = $parameterBag->get('rabbit-password');
        $vHost = $parameterBag->get('rabbit-vhost');

        $this->connection = new AMQPStreamConnection($host, $port, $username, $password, $vHost);
        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare(
            'private-created',
            'topic',
            false,
            true,
            false);

        $this->channel->exchange_declare(
            'private-changed',
            'topic',
            false,
            true,
            false);

        $this->channel->exchange_declare(
            'discussion-created',
            'topic',
            false,
            true,
            false);

        $this->channel->exchange_declare(
            'discussion-changed',
            'topic',
            false,
            true,
            false);

        $this->channel->exchange_declare(
            'dialog-created',
            'topic',
            false,
            true,
            false);
    }

    public function produce($messageObject, string $exchangeName, string $routingKey)
    {
        $data = $this->serializer->serialize($messageObject, 'json');
        $message = new AMQPMessage($data);
        $this->channel->basic_publish($message, $exchangeName, $routingKey);
    }
}