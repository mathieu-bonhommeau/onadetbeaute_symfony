<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Contact controller  - use for only contact form
 * It is call in global by base.html.twig on all pages in the footer
 * It use ajax for send the email
 */
class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contactForm(Request $request, MailerInterface $mailer): Response
    {
        $message = new Message();
        $form = $this->createForm(ContactType::class);
        
        if ($request->isXmlHttpRequest()) {

            $datas = json_decode($request->getContent(), true);
            
            try {
                $message->setEmail($datas['_email'])
                    ->setSubject($datas['_subject'])
                    ->setMessage($datas['_message']);

                $messageSend = (new Email())
                    ->from($message->getEmail())
                    ->to($this->getParameter('email'))
                    ->subject($message->getSubject())
                    ->text($message->getMessage());

                $mailer->send($messageSend);

                return new JsonResponse('Votre message à été envoyé !', 200);

            } catch (\Exception $e) {
                dump($e);
                return new JsonResponse('Votre messagen\a pas pu être envoyé !', 500);
            }
    
        }
        
        return $this->render('contact/_contact-form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
