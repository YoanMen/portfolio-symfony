<?php

namespace App\EventSubscriber;

use App\Event\ContactRequestEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MailingSubscriber implements EventSubscriberInterface
{

    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function onContactRequestEvent(ContactRequestEvent $event): void
    {

        $data = $event->data;
        $mail = (new TemplatedEmail())
            ->to('contact@test.com')
            ->subject("Message du portfolio par " . $data->name)
            ->from($data->email)
            ->htmlTemplate('email/contact.html.twig')
            ->context(['data' => $data]);

        $this->mailer->send($mail);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRequestEvent::class => 'onContactRequestEvent',
        ];
    }
}
