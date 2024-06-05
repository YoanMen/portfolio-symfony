<?php

namespace App\EventListener;

use App\Service\VisitorCountService;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class SessionListener
{

    public function __construct(private VisitorCountService $visitorCountService)
    {
    }

    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function onKernelRequest(RequestEvent $event)
    {

        return;

        $request = $event->getRequest();
        $session = $request->getSession();


        if (!$session->has('visited')) {
            $session->set('visited', true);

            $this->visitorCountService->incrementVisitor();
        }
    }
}
