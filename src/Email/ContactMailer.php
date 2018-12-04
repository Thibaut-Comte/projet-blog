<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 03/12/2018
 * Time: 10:11
 */

namespace App\Email;


use App\Entity\Contact;
use Twig\Environment;

class ContactMailer
{

    private $twig;

    private $mailer;

    private $emailAdmin;

    private $emailFrom;

    public function __construct(Environment $twig, \Swift_Mailer $mailer, string $emailAdmin, string $emailFrom)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->emailAdmin = $emailAdmin;
        $this->emailFrom = $emailFrom;
    }

    public function sendContactEmail(Contact $contact)
    {

        $message = new \Swift_Message();

        $message
            ->setTo($this->emailAdmin)
            ->setFrom($this->emailFrom)
            ->setSubject($contact->getSubject())
            ->setBody($contact->getMessage());

        $image = \Swift_Image::fromPath(
            __DIR__.'/../../public/imgs/test.jpg'
        );
        $image->setFilename('test.jpg');

        $imageCid = $message->embed($image);

        $bodyHtml = $this->twig->render('contact/email.html.twig', array(
            'contact' => $contact,
            'img' => $imageCid
        ));

        $message->addPart($bodyHtml, 'text/html');

        return $this->mailer->send($message);

    }
}