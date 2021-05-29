<?php

namespace App\Controller;

use App\Entity\Receiver;
use App\Entity\UserDevices;
use App\Model\DTO\ReceiverDTO;
use App\Model\DTO\UserDeviceDTO;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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
        /** @var UserDeviceDTO $addedDevice */
        $addedDevice = $this->serializer->deserialize($request->getContent(), UserDeviceDTO::class, 'json');

        $errors = $this->validator->validate($addedDevice);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if(!($user = $this->entityManager->getRepository(Receiver::class)->find($addedDevice->getUser()))) {
            throw new BadRequestHttpException('User not found');
        }

        if($this->entityManager->getRepository(UserDevices::class)
            ->findOneBy(['fcmKey' => $addedDevice->getFcmKey()])) {
            throw new BadRequestHttpException('This fcm key is already exists');
        }

        $newDevice = new UserDevices();
        $newDevice->setUser($user);
        $newDevice->setFcmKey($addedDevice->getFcmKey());
        $this->entityManager->persist($newDevice);
        $this->entityManager->flush();

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/management/device", name="remove_device", methods={"DELETE"})
     */
    public function removeDevice(Request $request) {
        /** @var UserDeviceDTO $addedDevice */
        $addedDevice = $this->serializer->deserialize($request->getContent(), UserDeviceDTO::class, 'json');

        $errors = $this->validator->validate($addedDevice);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if(!($existingDevice = $this->entityManager->getRepository(UserDevices::class)
            ->findOneBy(['user' => $addedDevice->getUser(), 'fcmKey' => $addedDevice->getFcmKey()]))) {
            throw new BadRequestHttpException('This fcm key is not belongs to specified user');
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
        /** @var ReceiverDTO $newReceiverData */
        $newReceiverData = $this->serializer->deserialize($request->getContent(), ReceiverDTO::class, 'json');

        $errors = $this->validator->validate($newReceiverData);
        if(count($errors)) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        if($this->entityManager->getRepository(Receiver::class)->find($newReceiverData->getId())) {
            throw new BadRequestHttpException('User is already exists');
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
        /** @var ReceiverDTO $patchingReceiver */
        $patchingReceiver = $this->serializer->deserialize($request->getContent(), ReceiverDTO::class, 'json');

        if(!($user = $this->entityManager->getRepository(Receiver::class)->find($patchingReceiver->getId()))) {
            throw new BadRequestHttpException('User not exists');
        }

        if(($updateMuteDiscussion = $patchingReceiver->getMuteDiscussion()) !== null) {
            $user->setMuteDiscussionMessages($updateMuteDiscussion);
        }

        if(($updateMutePrivate = $patchingReceiver->getMutePrivate()) !== null) {
            $user->setMutePrivateMessages($updateMutePrivate);
        }

        $this->entityManager->flush();
        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }

    /**
     * @param Request $request
     * @Route("/management/receiver", name="remove_receiver", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteReceiver(Request $request) {
        /** @var ReceiverDTO $deletingReceiver */
        $deletingReceiver = $this->serializer->deserialize($request->getContent(), ReceiverDTO::class, 'json');

        if(!($user = $this->entityManager->getRepository(Receiver::class)->find($deletingReceiver->getId()))) {
            throw new BadRequestHttpException('User not exists');
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new JsonResponse(json_encode(['success' => true]), Response::HTTP_OK, [], true);
    }
}