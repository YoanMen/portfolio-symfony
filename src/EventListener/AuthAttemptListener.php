<?php

namespace App\EventListener;

use App\Entity\AuthAttempt;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;

final class AuthAttemptListener
{

    public function __construct(private EntityManagerInterface $em, private RequestStack $requestStack)
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
            $authAttempt->setAttempt($authAttempt->getAttempt() + 1);
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
