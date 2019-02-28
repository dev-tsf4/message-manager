<?php

namespace App\Controller\Front;

use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/contact", methods={"GET", "POST"}, name="app_message_new")
     */
    public function new(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $message->setFrom($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_message_new');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
