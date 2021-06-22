<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Employee;


class EmployeeController extends AbstractController
{
    /**
     * @Route("/register_employee", name="register_employee")
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $alfa=$this->getDoctrine()
            ->getRepository(Employee::class)
            ->findOneBy(
                ['email' => $request->query->get('Email')]
            );
        if ($alfa==null){
            $product = new Employee();
            $product->setFirstName($request->query->get('First_name'));
            $product->setLastName($request->query->get('Last_name'));
            $product->setPassword($request->query->get('Password'));
            $product->setEmail($request->query->get('Email'));
            $product->setAccess($request->query->get('Access'));
            $entityManager->persist($product);
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            return new JsonResponse(['data' => $request->query->get('First_name'), 'message'=>'Saved new Employee with id '.$product->getId(),'success'=> true]);
            //return new Response('Saved new Client with id '.$product->getId());
        } else{
            return new JsonResponse([ 'message'=>'Employee with this email already exist','success'=> false]);

        }

    }

    /**
     * @Route("/update_employee/{id}", name="employee_update")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateEmployee(Request $request, int $id): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->find($id);
        if ($request->query->get('First_name')!= null){
            $product->setFirstName($request->query->get('First_name'));
        }
        if ($request->request->get('Last_name')!= null){
            $product->setLastName($request->query->get('Last_name'));
        }
        if ($request->request->get('Password')!= null){
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

        return new Response('Saved updates Employee with id '.$product->getId());
    }

    /**
     * @Route("/employee/{id}", name="employee_show")
     * @param int $id
     * @return JsonResponse
     */
    public function showEmployee(int $id):  JsonResponse
    {
        $product = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No employee found for id '.$id
            );
        }
        $product->getId();


        return new  JsonResponse(['data' => ['id'=> $product->getId(), 'FirstName'=>$product->getFirstName(), 'LastName'=>$product->getLastName(), 'access'=>$product->getAccess(),'email'=>$product->getEmail() ], 'message'=>'Client with id '.$product->getId(),'success'=> true]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/login_employee", name="employee_login")
     * @param Request $request
     * @return JsonResponse
     */
    public function Login(Request $request): JsonResponse
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findOneBy(
                ['email' => $request->query->get('Email')]
            );
        if ($product==null){
            return new JsonResponse(['success'=> false, 'message'=>'wrong email']);
        }
        if ($request->query->get('Password')== $product->getPassword()){
            return new JsonResponse(['data'=>['id'=> $product->getId(), 'FirstName'=>$product->getFirstName(), 'LastName'=>$product->getLastName(), 'access'=>$product->getAccess(),'email'=>$product->getEmail()], 'message'=>'Login success', 'success'=>true]);
        }else{
            return new JsonResponse(['success'=> false, 'message'=>'wrong password']);
        }

    }
}
