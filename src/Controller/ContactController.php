<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contactForm(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from('hello@example.com')
                ->to('you@example.com')
                ->subject('Test de MailDev')
                ->text('Ceci est un mail de test');
            
            $mailer->send($message);
            dump($mailer);

            $this->addFlash('success', 'Votre message a bien été envoyé');
            
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return $this->render('contact/_contact-form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
