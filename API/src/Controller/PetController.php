<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Pet;

class PetController extends AbstractController
{
    /**
     * @Route("/create_pet", name="create_pet")
     * @param Request $request
     * @return JsonResponse
     */
    public function createPet(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = new Pet();
        $product->setType($request->query->get('Type'));
        $product->setRace($request->query->get('Race'));
        $product->setBageNumber($request->query->get('Bage'));
        $product->setUserId($request->query->get('UserId'));
        $entityManager->persist($product);
        $entityManager->flush();
        return new JsonResponse(['data' => $request->query->get('First_name'), 'message'=>'Saved new Client with id '.$product->getId(),'success'=> true]);
    }

    /**
     * @Route("/user_pet/{id}", name="user_pet_show")
     * @param int $id
     * @return JsonResponse
     */
    public function showUserPet(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Pet::class)
            ->findOneBy(
                ['user_id' => $id]
            );

        if (!$product) {
            throw $this->createNotFoundException(
                'No pet found for id '.$id
            );
        }
        return new  JsonResponse(['data' => ['bage'=> $product->getId(), 'race'=>$product->getRace(), 'type'=>$product->getType()], 'message'=>'Pets for the Client with id '.$id,'success'=> true]);
    }
    /**
     * @Route("/user_pet_delete/{id}", name="user_pet_delete")
     * @param int $id
     * @return JsonResponse
     */
    public function deleteUserPet(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Pet::class)
            ->findOneBy(
                ['user_id' => $id]
            );

        if (!$product) {
            throw $this->createNotFoundException(
                'No pet found for id '.$id
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();
        return new  JsonResponse(['message'=>'Pet deleted for the Client with id '.$id,'success'=> true]);
    }

}
