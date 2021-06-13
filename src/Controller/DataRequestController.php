<?php

namespace App\Controller;

use App\Entity\Receiver;
use App\Model\DTO\Attachment;
use App\Model\DTO\Dialog;
use App\Model\DTO\DiscussionMessage;
use App\Model\Query\DialogCreateQueryParam;
use App\Model\DTO\ExternalLink;
use App\Model\Query\DiscussionMessageQueryParam;
use App\Model\Query\PrivateMessageQueryParam;
use App\Model\DTO\Person;
use App\Model\DTO\PrivateMessage;
use App\Repository\ReceiverRepository;
use App\Service\FcmService;
use App\Service\QueryService;
use App\Service\RabbitService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DataRequestController
 * @package App\Controller
 * @Route("/data")
 */
class DataRequestController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var RabbitService
     */
    private $rabbitService;

    public function __construct(SerializerInterface $serializer, RabbitService $rabbitService)
    {
        $this->serializer = $serializer;
        $this->rabbitService = $rabbitService;
    }

    /**
     * @param Request $request
     * @Route("/private/change", name="private_changed", methods={"POST"})
     * @return Response
     */
    public function notifyPrivateMessageChanged(Request $request) {
        /** @var PrivateMessageQueryParam $readEvent */
        $readEvent = $this->serializer->deserialize(
            $request->getContent(),
            PrivateMessageQueryParam::class,
            'json'
        );

        $privateMessage = new PrivateMessage();
        $privateMessage->setChat($readEvent->getDialog());
        $privateMessage->setId($readEvent->getMessageId());
        $privateMessage->setMessageText($readEvent->getTextContent());
        $privateMessage->setSendTime($readEvent->getCreatedAt());

        $sender = new Person();
        $sender->setUoid($readEvent->getSenderId());
        $sender->setFname($readEvent->getSenderName());
        $sender->setLname($readEvent->getSenderSurname());
        $sender->setPatronymic($readEvent->getSenderPatronymic());
        $privateMessage->setSender($sender);

        if($readEvent->getDocName() || $readEvent->getDocSize()) {
            $fileAttachment = new Attachment();
            $fileAttachment->setAttachmentName($readEvent->getDocName());
            $fileAttachment->setAttachmentSize($readEvent->getDocSize());
            $privateMessage->setAttachments([$fileAttachment]);
        }

        if($readEvent->getLinkContent() || $readEvent->getLinkText()) {
            $externalLink = new ExternalLink();
            $externalLink->setLinkContent($readEvent->getLinkContent());
            $externalLink->setLinkText($readEvent->getLinkText());
            $privateMessage->setLinks([$externalLink]);
        }

        $privateMessage->setMeSender($readEvent->getSenderId() === $readEvent->getMember1());
        $privateMessage->setIsRead($readEvent->getMember1Read());

        $this->rabbitService->produce(
            $privateMessage,
            'private-changed',
            "{$privateMessage->getChat()}.{$readEvent->getMember1()}"
        );

        $privateMessage->setMeSender($readEvent->getSenderId() === $readEvent->getMember2());
        $privateMessage->setIsRead($readEvent->getMember2Read());

        $this->rabbitService->produce(
            $privateMessage,
            'private-changed',
            "{$privateMessage->getChat()}.{$readEvent->getMember2()}"
        );

        return new Response();
    }

    /**
     * @param Request $request
     * @Route("/dialog/add", name="dialog_created", methods={"POST"})
     * @return Response
     */
    public function notifyDialogCreated(Request $request) {
        /** @var DialogCreateQueryParam $createdDialog */
        $createdDialog = $this->serializer->deserialize(
            $request->getContent(),
            DialogCreateQueryParam::class,
            'json'
        );

        $dialog = new Dialog();
        $dialog->setId($createdDialog->getDialogId());

        $member1 = new Person();
        $member1->setUoid($createdDialog->getMember1Id());
        $member1->setFname($createdDialog->getMember1Name());
        $member1->setLname($createdDialog->getMember1Surname());
        $member1->setPatronymic($createdDialog->getMember1Patronymic());

        $member2 = new Person();
        $member2->setUoid($createdDialog->getMember2Id());
        $member2->setFname($createdDialog->getMember2Name());
        $member2->setLname($createdDialog->getMember2Surname());
        $member2->setPatronymic($createdDialog->getMember2Patronymic());

        if($createdDialog->getLastMessageId()) {
            $lastMessage = new PrivateMessage();
            $lastMessage->setMessageText($createdDialog->getLastMessageText());
            $lastMessage->setId($createdDialog->getLastMessageId());
            $lastMessage->setSendTime($createdDialog->getLastSendTime());


            if ($createdDialog->getLastAuthor() === $createdDialog->getMember1Id()) {
                $lastMessage->setSender($member1);
            } elseif ($createdDialog->getLastAuthor() === $createdDialog->getMember2Id()) {
                $lastMessage->setSender($member2);
            }

            $dialog->setLastMessage($lastMessage);
        }

        $dialog->setCompanion($member2);
        $dialog->setUnreadCount($createdDialog->getUnread1Count());
        $dialog->setHasUnread($createdDialog->getUnread1Count() == 0);

        $this->rabbitService->produce($dialog, 'dialog-created', $member1->getUoid());

        $dialog->setCompanion($member1);
        $dialog->setUnreadCount($createdDialog->getUnread2Count());
        $dialog->setHasUnread($createdDialog->getUnread2Count() == 0);

        $this->rabbitService->produce($dialog, 'dialog-created', $member2->getUoid());

        return new Response();
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param QueryService $queryService
     * @param FcmService $fcmService
     * @return Response
     * @throws Exception
     * @Route("/discussion/add", name="discussion_created", methods={"POST"})
     */
    public function notifyDiscussionMessageCreated(
        Request $request,
        EntityManagerInterface $entityManager,
        QueryService $queryService,
        FcmService $fcmService
    ) {
        /** @var DiscussionMessageQueryParam $createdDiscussionMessage */
        $createdDiscussionMessage = $this->serializer->deserialize(
            $request->getContent(),
            DiscussionMessageQueryParam::class,
            'json'
        );

        $discussionMessage = new DiscussionMessage();
        $discussionMessage->setId($createdDiscussionMessage->getId());
        $discussionMessage->setGroup($createdDiscussionMessage->getGroup());
        $discussionMessage->setDiscipline($createdDiscussionMessage->getDiscipline());
        $discussionMessage->setSemester($createdDiscussionMessage->getSemester());
        $discussionMessage->setCreated($createdDiscussionMessage->getCreatedAt());
        $discussionMessage->setMsg($createdDiscussionMessage->getTextContent());

        $person = new Person();
        $person->setUoid($createdDiscussionMessage->getSenderId());
        $person->setFname($createdDiscussionMessage->getSenderName());
        $person->setLname($createdDiscussionMessage->getSenderSurname());
        $person->setPatronymic($createdDiscussionMessage->getSenderPatronymic());
        $discussionMessage->setSender($person);

        if($createdDiscussionMessage->getDocSize() || $createdDiscussionMessage->getDocName()) {
            $attachment = new Attachment();
            $attachment->setAttachmentSize($createdDiscussionMessage->getDocSize());
            $attachment->setAttachmentName($createdDiscussionMessage->getDocName());
            $discussionMessage->setAttachments([$attachment]);
        }

        if($createdDiscussionMessage->getLinkText() || $createdDiscussionMessage->getLinkContent()) {
            $externalLink = new ExternalLink();
            $externalLink->setLinkText($createdDiscussionMessage->getLinkText());
            $externalLink->setLinkContent($createdDiscussionMessage->getLinkContent());
            $discussionMessage->setExternalLinks([$externalLink]);
        }

        $this->rabbitService->produce(
            $discussionMessage,
            'discussion-created',
            $createdDiscussionMessage->getGroup()
        );

        $dialogMembers = $queryService->getChatMemberList(
            $createdDiscussionMessage->getGroup(),
            $createdDiscussionMessage->getDiscipline(),
            $createdDiscussionMessage->getSemester()
        );

        /** @var ReceiverRepository $receiverRepository */
        $receiverRepository = $entityManager->getRepository(Receiver::class);
        $receivers = $receiverRepository->getRegisteredReceiversPreferences($dialogMembers);

        foreach ($receivers as $receiver) {
            if(!$receiver['dsc'] && ($fcmToken = $receiver['fcm'])) {
                $fcmService->sendWithDeviceId('Обновление в обсуждении',
                    "{$createdDiscussionMessage->getSenderName()} {$createdDiscussionMessage->getSenderSurname()}: {$createdDiscussionMessage->getTextContent()}",
                    $fcmToken
                );
            }
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @Route("/discussion/change", name="discussion_changed", methods={"POST"})
     * @return Response
     */
    public function notifyDiscussionMessageChanged(Request $request) {
        /** @var DiscussionMessageQueryParam $createdDiscussionMessage */
        $createdDiscussionMessage = $this->serializer->deserialize(
            $request->getContent(),
            DiscussionMessageQueryParam::class,
            'json'
        );

        $discussionMessage = new DiscussionMessage();
        $discussionMessage->setId($createdDiscussionMessage->getId());
        $discussionMessage->setGroup($createdDiscussionMessage->getGroup());
        $discussionMessage->setDiscipline($createdDiscussionMessage->getDiscipline());
        $discussionMessage->setSemester($createdDiscussionMessage->getSemester());
        $discussionMessage->setCreated($createdDiscussionMessage->getCreatedAt());
        $discussionMessage->setMsg($createdDiscussionMessage->getTextContent());

        $person = new Person();
        $person->setUoid($createdDiscussionMessage->getSenderId());
        $person->setFname($createdDiscussionMessage->getSenderName());
        $person->setLname($createdDiscussionMessage->getSenderSurname());
        $person->setPatronymic($createdDiscussionMessage->getSenderPatronymic());
        $discussionMessage->setSender($person);

        if($createdDiscussionMessage->getDocSize() || $createdDiscussionMessage->getDocName()) {
            $attachment = new Attachment();
            $attachment->setAttachmentSize($createdDiscussionMessage->getDocSize());
            $attachment->setAttachmentName($createdDiscussionMessage->getDocName());
            $discussionMessage->setAttachments([$attachment]);
        }

        if($createdDiscussionMessage->getLinkText() || $createdDiscussionMessage->getLinkContent()) {
            $externalLink = new ExternalLink();
            $externalLink->setLinkText($createdDiscussionMessage->getLinkText());
            $externalLink->setLinkContent($createdDiscussionMessage->getLinkContent());
            $discussionMessage->setExternalLinks([$externalLink]);
        }

        $this->rabbitService->produce(
            $discussionMessage,
            'discussion-changed',
            $createdDiscussionMessage->getGroup()
        );

        return new Response();
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param FcmService $fcmService
     * @return Response
     * @Route("/private/add", name="message_created", methods={"POST"})
     */
    public function notifyPrivateMessageCreated(
        Request $request,
        EntityManagerInterface $entityManager,
        FcmService $fcmService
    ) {
        /** @var PrivateMessageQueryParam $createdPrivateMessage */
        $createdPrivateMessage = $this->serializer->deserialize(
            $request->getContent(),
            PrivateMessageQueryParam::class,
            'json'
        );

        $privateMessage = new PrivateMessage();
        $privateMessage->setChat($createdPrivateMessage->getDialog());
        $privateMessage->setId($createdPrivateMessage->getMessageId());
        $privateMessage->setMessageText($createdPrivateMessage->getTextContent());
        $privateMessage->setSendTime($createdPrivateMessage->getCreatedAt());

        $sender = new Person();
        $sender->setUoid($createdPrivateMessage->getSenderId());
        $sender->setFname($createdPrivateMessage->getSenderName());
        $sender->setLname($createdPrivateMessage->getSenderSurname());
        $sender->setPatronymic($createdPrivateMessage->getSenderPatronymic());
        $privateMessage->setSender($sender);

        if($createdPrivateMessage->getDocName() || $createdPrivateMessage->getDocSize()) {
            $fileAttachment = new Attachment();
            $fileAttachment->setAttachmentName($createdPrivateMessage->getDocName());
            $fileAttachment->setAttachmentSize($createdPrivateMessage->getDocSize());
            $privateMessage->setAttachments([$fileAttachment]);
        }

        if($createdPrivateMessage->getLinkContent() || $createdPrivateMessage->getLinkText()) {
            $externalLink = new ExternalLink();
            $externalLink->setLinkContent($createdPrivateMessage->getLinkContent());
            $externalLink->setLinkText($createdPrivateMessage->getLinkText());
            $privateMessage->setLinks([$externalLink]);
        }

        $privateMessage->setMeSender($createdPrivateMessage->getSenderId() === $createdPrivateMessage->getMember1());
        $privateMessage->setIsRead($createdPrivateMessage->getMember1Read());

        $this->rabbitService->produce(
            $privateMessage,
            'private-created',
            "{$privateMessage->getChat()}.{$createdPrivateMessage->getMember1()}"
        );

        $privateMessage->setMeSender($createdPrivateMessage->getSenderId() === $createdPrivateMessage->getMember2());
        $privateMessage->setIsRead($createdPrivateMessage->getMember2Read());

        $this->rabbitService->produce(
            $privateMessage,
            'private-created',
            "{$privateMessage->getChat()}.{$createdPrivateMessage->getMember2()}"
        );

        /** @var ReceiverRepository $receiverRepository */
        $receiverRepository = $entityManager->getRepository(Receiver::class);

        /** @var Receiver $receiver */
        $receiver = $receiverRepository->find(
            $createdPrivateMessage->getSenderId() == $createdPrivateMessage->getMember1()
                ? $createdPrivateMessage->getMember2()
                : $createdPrivateMessage->getMember1()
        );

        if($receiver) {
            $devices = $receiver->getDevices();
            foreach ($devices as $device) {
                $fcmService->sendWithDeviceId(
                    'Новое сообщение',
                    "{$createdPrivateMessage->getSenderName()} {$createdPrivateMessage->getSenderSurname()}: {$createdPrivateMessage->getTextContent()}",
                    $device->getFcmKey()
                );
            }
        }

        return new Response();
    }
}