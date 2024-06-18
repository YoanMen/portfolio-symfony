<?php

namespace App\Controller\API;

use App\DTO\ContactDTO;
use App\Event\ContactRequestEvent;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

  #[Route('api/contact', methods: ['POST'], name: 'app_contact')]
  public function index(Request $request, EventDispatcherInterface $dispatcher)
  {


    $data = new ContactDTO();

    $form = $this->createForm(ContactType::class, $data);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {


      try {
        $dispatcher->dispatch(new ContactRequestEvent($data));
        return new JsonResponse(['success' => true]);
      } catch (\Exception $e) {

        return new JsonResponse(['success' => false, 'error' => 'Internal error']);
      }
    } else {

      return new JsonResponse(['success' => false, 'error' => "Error cant sent mail, data not valid"]);
    }
  }
}
