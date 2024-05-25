<?php

namespace App\Controller\API;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

  #[Route('api/contact', methods: ['POST'], name: 'app_contact')]
  public function index(Request $request, MailerInterface $mailer)
  {


    $data = new ContactDTO();

    $form = $this->createForm(ContactType::class, $data);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      try {
        $mail = (new TemplatedEmail())->to('contact@test.com')
          ->subject("Message du portfolio par " . $data->name)
          ->from($data->email)
          ->htmlTemplate('email/contact.html.twig')
          ->context(['data' => $data]);


        $mailer->send($mail);
        return new JsonResponse(['success' => true]);
      } catch (TransportExceptionInterface $e) {

        return new JsonResponse(['success' => false, 'error' => $e->getMessage()]);
      }
    } else {

      return new JsonResponse(['success' => false, 'error' => "Error cant sent mail", 'data' => ""]);
    }
  }
}
