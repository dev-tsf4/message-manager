<?php

namespace App\Controller\Admin\Dashboard;

use App\Entity\Message;
use App\Form\DashboardMessageType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="admin_message_list")
     */
    public function index(MessageRepository $messageRepository)
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'messages' => $messageRepository->findOrderMessagesByCreate(),
        ]);
    }

    /**
     * @Route("/{id<\d+>}/edit",methods={"GET", "POST"}, name="admin_message_edit")
     */
    public function edit(Request $request, Message $message)
    {
        $form = $this->createForm(DashboardMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Message modifié avec succès');

            return $this->redirectToRoute('admin_message_edit', [
                'id' => $message->getId()
                ]);
        }

        return $this->render('admin/dashboard/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView()
        ]);
    }
}
