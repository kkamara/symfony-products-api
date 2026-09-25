<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    #[AsEventListener]
    public function onExceptionEvent(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        $path = $request->getPathInfo();

        if (false === strpos($path, '/api')) {
            return;
        }

        $exception = $event->getThrowable();

        $response = new JsonResponse([
            "error" => $exception->getMessage(),
        ]);

        $event->setResponse($response);
    }
}
