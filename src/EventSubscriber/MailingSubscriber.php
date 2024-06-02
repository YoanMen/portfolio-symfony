<?php

namespace App\EventSubscriber;

use Symfony\Component\Mime\Email;
use App\Event\ContactRequestEvent;
use Symfony\Component\Mailer\Mailer;
use App\Event\AccountLockedRequestEvent;
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
            ->to(EMAIL)
            ->subject("Message du portfolio par " . $data->name)
            ->from($data->email)
            ->htmlTemplate('email/contact.html.twig')
            ->context(['data' => $data]);

        $this->mailer->send($mail);
    }

    public function onAccountLockedRequestEvent(AccountLockedRequestEvent $event): void
    {
        $mail = (new Email())
            ->from(EMAIL)
            ->to(EMAIL)
            ->subject('ACCOUNT LOCKED')
            ->text('Your account has been locked');

        $this->mailer->send($mail);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRequestEvent::class => 'onContactRequestEvent',
            AccountLockedRequestEvent::class => 'onAccountLockedRequestEvent',
        ];
    }
}
