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

    $contactForm = $this->createForm(ContactType::class, $data);

    $contactForm->handleRequest($request);

    if ($contactForm->isSubmitted() && $contactForm->isValid()) {

      try {
        $mail = (new TemplatedEmail())->to('contact@test.com')
          ->from($data->email)
          ->htmlTemplate('email/contact.html.twig')
          ->context(['data' => $data]);


        $mailer->send($mail);
      } catch (TransportExceptionInterface $e) {
        return new JsonResponse(['success' => false, 'error' => $e->getMessage()]);
      }


      return new JsonResponse(['success' => true]);
    }

    return new JsonResponse(['success' => false, 'error' => $contactForm->getErrors()]);
  }
}
