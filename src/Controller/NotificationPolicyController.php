<?php

namespace App\Controller;

use App\Entity\Receiver;
use App\Entity\UserDevices;
use App\Model\Query\ReceiverQueryParam;
use App\Model\Query\UserDeviceQueryParam;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NotificationPolicyController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ){
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/management/device", name="add_device", methods={"POST"})
     */
    public function addDevice(Request $request) {
        /** @var UserDeviceQueryParam $addedDevice */
        $addedDevice = $this->serializer->deserialize($request->getContent(), UserDeviceQueryParam::class, 'json');

        $errors = $this->validator->validate($addedDevice);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if(!($user = $this->entityManager->getRepository(Receiver::class)->find($addedDevice->getUser()))) {
            throw new NotFoundHttpException('User not found');
        }

        if(!$this->entityManager->getRepository(UserDevices::class)
            ->findOneBy(['fcmKey' => $addedDevice->getFcmKey()])) {
            $newDevice = new UserDevices();
            $newDevice->setUser($user);
            $newDevice->setFcmKey($addedDevice->getFcmKey());
            $this->entityManager->persist($newDevice);
            $this->entityManager->flush();
        }

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/management/device", name="remove_device", methods={"DELETE"})
     */
    public function removeDevice(Request $request) {
        /** @var UserDeviceQueryParam $addedDevice */
        $addedDevice = $this->serializer->deserialize($request->getContent(), UserDeviceQueryParam::class, 'json');

        $errors = $this->validator->validate($addedDevice);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if(!($existingDevice = $this->entityManager->getRepository(UserDevices::class)
            ->findOneBy(['user' => $addedDevice->getUser(), 'fcmKey' => $addedDevice->getFcmKey()]))) {
            throw new NotFoundHttpException('This fcm key is not belongs to specified user');
        }

        $this->entityManager->remove($existingDevice);
        $this->entityManager->flush();

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @Route("/management/receiver", name="add_receiver", methods={"POST"})
     * @return JsonResponse
     */
    public function addReceiver(Request $request) {
        /** @var ReceiverQueryParam $newReceiverData */
        $newReceiverData = $this->serializer->deserialize($request->getContent(), ReceiverQueryParam::class, 'json');

        $errors = $this->validator->validate($newReceiverData);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if($this->entityManager->getRepository(Receiver::class)->find($newReceiverData->getId())) {
            throw new ConflictHttpException('User is already exists');
        }

        $receiver = new Receiver();
        $receiver->setId($newReceiverData->getId());
        $receiver->setMutePrivateMessages($newReceiverData->getMutePrivate());
        $receiver->setMuteDiscussionMessages($newReceiverData->getMuteDiscussion());
        $this->entityManager->persist($receiver);
        $this->entityManager->flush();

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @Route("/management/receiver", name="update_receiver", methods={"PATCH"})
     * @return JsonResponse
     */
    public function updateReceiver(Request $request) {
        /** @var ReceiverQueryParam $patchingReceiver */
        $patchingReceiver = $this->serializer->deserialize($request->getContent(), ReceiverQueryParam::class, 'json');

        if(!($user = $this->entityManager->getRepository(Receiver::class)->find($patchingReceiver->getId()))) {
            throw new NotFoundHttpException('User not exists');
        }

        if(($updateMuteDiscussion = $patchingReceiver->getMuteDiscussion()) !== null) {
            $user->setMuteDiscussionMessages($updateMuteDiscussion);
        }

        if(($updateMutePrivate = $patchingReceiver->getMutePrivate()) !== null) {
            $user->setMutePrivateMessages($updateMutePrivate);
        }

        $this->entityManager->flush();
        $serializedUser = $this->serializer->serialize($user, 'json');
        return new JsonResponse($serializedUser, Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @Route("/management/receiver", name="remove_receiver", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteReceiver(Request $request) {
        /** @var ReceiverQueryParam $deletingReceiver */
        $deletingReceiver = $this->serializer->deserialize($request->getContent(), ReceiverQueryParam::class, 'json');

        if($user = $this->entityManager->getRepository(Receiver::class)->find($deletingReceiver->getId())) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @Route("/management/receiver", name="get_receiver", methods={"GET"})
     * @return JsonResponse
     */
    public function getReceiver(Request $request) {
        $receiverId = $request->query->get('receiver');

        if(!$receiverId) {
            throw new BadRequestHttpException('Incorrect parameter user');
        }

        /** @var Receiver $receiver */
        $receiver = $this->entityManager->getRepository(Receiver::class)->find($receiverId);

        if(!$receiver) {
            throw new NotFoundHttpException('User not exists');
        }

        $serializedUser = $this->serializer->serialize($receiver, 'json');
        return new JsonResponse($serializedUser, Response::HTTP_OK, [], true);
    }
}