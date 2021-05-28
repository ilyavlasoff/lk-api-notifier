<?php

namespace App\Controller;

use App\Entity\Receiver;
use App\Model\CompanionRead;
use App\Model\CreatedDialog;
use App\Model\CreatedDiscussionMessage;
use App\Model\CreatedPrivateMessage;
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
     * @Route("/msg-read", name="message_read", methods={"POST"})
     * @return Response
     */
    public function notifyCompanionRead(Request $request) {
        $readEvent = $this->serializer->deserialize(
            $request->getContent(),
            CompanionRead::class,
            'json'
        );
        $this->rabbitService->produce($readEvent);
        return new Response();
    }

    /**
     * @param Request $request
     * @Route("/dialog-created", name="dialog_created", methods={"POST"})
     * @return Response
     */
    public function notifyCreatedDialog(Request $request) {
        $createdDialog = $this->serializer->deserialize(
            $request->getContent(),
            CreatedDialog::class,
            'json'
        );
        $this->rabbitService->produce($createdDialog);
        return new Response();
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param QueryService $queryService
     * @param FcmService $fcmService
     * @return Response
     * @throws Exception
     * @Route("/discussion-msg-created", name="discussion_created", methods={"POST"})
     */
    public function notifyCreatedDiscussionMessage(
        Request $request,
        EntityManagerInterface $entityManager,
        QueryService $queryService,
        FcmService $fcmService
    ) {
        /** @var CreatedDiscussionMessage $createdDiscussionMessage */
        $createdDiscussionMessage = $this->serializer->deserialize(
            $request->getContent(),
            CreatedDiscussionMessage::class,
            'json'
        );
        $this->rabbitService->produce($createdDiscussionMessage);

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
                $fcmService->sendWithDeviceId($createdDiscussionMessage, $fcmToken);
            }
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param FcmService $fcmService
     * @return Response
     * @Route("/message-created", name="message_created", methods={"POST"})
     */
    public function notifyCreatedMessage(Request $request, EntityManagerInterface $entityManager, FcmService $fcmService) {
        /** @var CreatedPrivateMessage $createdPrivateMessage */
        $createdPrivateMessage = $this->serializer->deserialize(
            $request->getContent(),
            CreatedPrivateMessage::class,
            'json'
        );
        $this->rabbitService->produce($createdPrivateMessage);

        /** @var ReceiverRepository $receiverRepository */
        $receiverRepository = $entityManager->getRepository(Receiver::class);

        /** @var Receiver $receiver */
        $receiver = $receiverRepository->find($createdPrivateMessage->getSenderCompanion());

        if($receiver) {
            $devices = $receiver->getDevices();
            foreach ($devices as $device) {
                $fcmService->sendWithDeviceId($createdPrivateMessage, $device->getFcmKey());
            }
        }

        return new Response();
    }
}