<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Command;

class CommandController extends AbstractController
{
    /**
     * @Route("/create_command", name="create_command")
     * @param Request $request
     * @return JsonResponse
     */
    public function createCommand(Request $request): JsonResponse
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Command();
        $product->setUserId($request->query->get('User_id'));
        $product->setProductName($request->query->get('Product_name'));
        $product->setReference($request->query->get('Reference'));
        $product->setStorage($request->query->get('Storage'));
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new JsonResponse(['data'=>['reference'=>$product->getReference()],'message'=>'Saved new Command with id '.$product->getId(),'success'=> true]);
        //return new Response('Saved new Client with id '.$product->getId());
    }

    /**
     * @Route("/command/{id}", name="command_show")
     * @param int $id
     * @return JsonResponse
     */
    public function showCommand(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Command::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No command found for id '.$id
            );
        }
        $product->getId();


        return new  JsonResponse(['data' => ['id'=> $product->getId(), 'UserId'=>$product->getUserId(), 'Name'=>$product->getProductName(), 'Storage'=>$product->getStorage()], 'message'=>'Client with id '.$product->getId(),'success'=> true]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
