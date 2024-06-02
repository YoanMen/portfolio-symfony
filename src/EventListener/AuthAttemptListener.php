<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\AuthAttempt;
use App\Event\AccountLockedRequestEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class AuthAttemptListener
{

    public function __construct(private EntityManagerInterface $em, private RequestStack $requestStack, private EventDispatcherInterface $dispatcher)
    {
    }


    #[AsEventListener(event: LoginFailureEvent::class)]
    public function onSecurityAuthenticationError(LoginFailureEvent $event): void
    {

        $passport = $event->getPassport()->getUser();

        $user = $this->em->getRepository(User::class)
            ->findOneBy(['username' => $passport->getUserIdentifier()]);

        if (!$user) {
            return;
        }

        $authAttempt = $user->getAuthAttempt();

        if ($authAttempt) {
            // increment attempt
            $attemptCount = $authAttempt->getAttempt() + 1;

            $authAttempt->setAttempt($attemptCount);

            // event to send mail to user
            if ($attemptCount == 5) {
                $this->dispatcher->dispatch(new AccountLockedRequestEvent());
            }
        } else {
            // create a new auth attempt for user
            $authAttempt = new AuthAttempt();

            $authAttempt->setUser($user);
            $authAttempt->setAttempt(1);
        }

        // save attempt date and ip
        $authAttempt->setAttemptAt(new \DateTimeImmutable());
        $authAttempt->setIp($this->requestStack->getCurrentRequest()->getClientIp());

        $this->em->persist($authAttempt);
        $this->em->flush();
    }
}
