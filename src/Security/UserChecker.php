<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface
{

  public function __construct(private EntityManagerInterface $em)
  {
  }

  public function checkPreAuth(UserInterface $user): void
  {
    if (!$user instanceof AppUser) {
      return;
    }

    $authAttempt = $user->getAuthAttempt();

    if ($authAttempt && $authAttempt->getAttempt() > 5) {
      throw new CustomUserMessageAccountStatusException('Your account has been locked due to too many failed login attempts.');
    }
  }

  public function checkPostAuth(UserInterface $user): void
  {
    if (!$user instanceof AppUser) {
      return;
    }

    $authAttempt = $user->getAuthAttempt();

    if ($authAttempt) {
      $authAttempt->setAttempt(0);
      $this->em->persist($authAttempt);
      $this->em->flush();
    }
  }
}
