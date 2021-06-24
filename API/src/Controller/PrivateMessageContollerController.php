<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\PviateMessages;

class PrivateMessageContollerController extends AbstractController
{
    /**
     * @Route("/new_private_message", name="new_private_message")
     * @param Request $request
     * @return JsonResponse
     */
    public function new_global_message(Request $request): JsonResponse
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $product = new PviateMessages();
        $today=date("Y-m-d H:i:s");
        $product->setCreationTime(date_create($today));
        $product->setMessage($request->query->get('Message'));
        $product->setCreatorId($request->query->get('CreatorId'));
        $product->setDestinatorId($request->query->get('DestinatorId'));
        $entityManager->persist($product);
        $entityManager->flush();
        return new JsonResponse(['data' => $request->query->get('Message'), 'message'=>'Saved new Message with id '.$product->getId(),'success'=> true]);
    }
    /**
     * @Route("/show_private_messages/{id}", name="show_global_message")
     * @param int $id
     * @return JsonResponse
     */
    public function showGlobalMessage(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(PviateMessages::class)
            ->findBy(
                ['destinator_id' => $id]
            );
        $data=[];
        foreach ($product as $i){

            $name=$i->getId();
            $id_1=$i->getMessage();
            $storage=$i->getCreatorId();
            $storage_1=$i->getCreationTime();
            $data1=['Id'=>$name, 'Message'=>$id_1, 'Creator_id'=>$storage, 'CreationTime'=>$storage_1];
            array_push($data, $data1);
        }
        return new  JsonResponse(['data' => $data, 'message'=>'Messages for the employee with id '.$id,'success'=> true]);
    }
}
