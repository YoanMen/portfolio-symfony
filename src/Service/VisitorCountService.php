<?php

namespace App\Service;

use DateTimeImmutable;
use App\Document\Visitors;
use Doctrine\ODM\MongoDB\DocumentManager;

class VisitorCountService
{


  public function __construct(private DocumentManager $documentManager)
  {
  }

  public function incrementVisitor()
  {
    $repository = $this->documentManager->getRepository(Visitors::class);

    $currentDate = new DateTimeImmutable();
    $currentDateStart = $currentDate->setTime(0, 0, 0);

    $visitCounter = $repository->findOneBy(['date' => $currentDateStart]);

    if (!$visitCounter) {
      $visitCounter = new Visitors();
      $visitCounter->setNumber(1);
      $visitCounter->setDate($currentDateStart);
    } else {
      $visitCounter->setNumber($visitCounter->getNumber() + 1);
    }

    $this->documentManager->persist($visitCounter);
    $this->documentManager->flush();
  }
}
