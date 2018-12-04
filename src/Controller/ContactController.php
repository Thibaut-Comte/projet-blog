<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 19/10/2018
 * Time: 13:22
 */

namespace App\Controller;


use App\Email\ContactMailer;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{

    /**
     * @Route("/contact")
     */
    public function index(Request $request, ContactMailer $mailer)
    {

        $contact = new Contact();

        $contact->setSubject('Contact depuis le site web');

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $mailer->sendContactEmail($contact);

            $this->addFlash('success', 'Votre message à bien été envoyé');

            return $this->redirectToRoute('app_contact_index');
        }

        return $this->render("/contact/index.html.twig", array(
            'contactForm' => $form->createView()
        ));

    }

}