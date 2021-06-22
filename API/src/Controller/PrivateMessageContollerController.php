<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivateMessageContollerController extends AbstractController
{
    /**
     * @Route("/private/message/contoller", name="private_message_contoller")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PrivateMessageContollerController.php',
        ]);
    }
}
