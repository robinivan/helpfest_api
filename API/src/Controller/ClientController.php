<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClientController.php',
        ]);
    }

    /**
     * @Route("/create_client", name="create_product")
     * @param Request $request
     * @return JsonResponse
     */
    public function createClient(Request $request): JsonResponse
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Client();
        /*$product->setFirstName('Ivan');
        $product->setLastName('Robin');
        $product->setTransactionNumber(1);
        $product->setEmail('ivan.robin@epitech.digital');
        $product->setAccess(5);*/
        $product->setFirstName($request->query->get('First_name'));
        $product->setLastName($request->query->get('Last_name'));
        $product->setTransactionNumber($request->query->get('Transaction_number'));
        $product->setEmail($request->query->get('Email'));
        $product->setAccess($request->query->get('Access'));
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new JsonResponse(['data' => $request->query->get('First_name'), 'message'=>'Saved new Client with id '.$product->getId(),'success'=> true]);
        //return new Response('Saved new Client with id '.$product->getId());
    }

    /**
     * @Route("/update_client", name="client_update")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateProduct(Request $request, int $id): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()
            ->getRepository(Client::class)
            ->find($id);
        if ($request->query->get('First_name')!= null){
            $product->setFirstName($request->query->get('First_name'));
        }
        if ($request->request->get('Last_name')!= null){
            $product->setLastName($request->query->get('Last_name'));
        }
        if ($request->request->get('Transaction_number')!= null){
            $product->setTransactionNumber($request->query->get('Transaction_number'));
        }
        if ($request->request->get('Email')!= null){
            $product->setEmail($request->query->get('Email'));
        }
        if ($request->request->get('Access')!= null){
            $product->setAccess($request->query->get('Access'));
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new Client with id '.$product->getId());
    }

    /**
     * @Route("/client/{id}", name="client_show")
     * @param int $id
     * @return JsonResponse
     */
    public function showClient(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Client::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No client found for id '.$id
            );
        }
        $product->getId();


        return new  JsonResponse(['data' => ['id'=> $product->getId(), 'FirstName'=>$product->getFirstName(), 'LastName'=>$product->getLastName(), 'access'=>$product->getAccess()], 'message'=>'Client with id '.$product->getId(),'success'=> true]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
