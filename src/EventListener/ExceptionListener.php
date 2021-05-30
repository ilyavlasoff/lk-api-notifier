<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $exceptionEvent) {
        $exception = $exceptionEvent->getThrowable();

        $jsonResponse = new JsonResponse();

        if($exception instanceof \HttpException) {
            $code = $exception->getStatusCode();
        } else {
            $code = 500;
        }

        $jsonResponse->setStatusCode($code);
        $errorData = json_encode(
            ['code' => $code, 'message' => $exception->getMessage()]);

        $jsonResponse->setContent($errorData);
        $exceptionEvent->setResponse($jsonResponse);
    }
}