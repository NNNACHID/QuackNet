<?php

namespace App\Controller;

use App\Entity\Quack;
use App\Repository\QuackRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;

/**
 * @Route("/quack", name="quack")
 */

class QuackController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */

    public function index(QuackRepository $repository): Response
    {

        return $this->render('quack/index.html.twig', [
            'controller_name' => 'QuackController',
            'quacks' => $repository->findAll()

        ]);
    }

    /**
    *@Route("/create", name="create")
     * */

    public function create(Request $request): Response
    {
        
        $quack = new Quack();
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($quack);
        $entityManager->flush();

        return $this->render('quack/createQuack.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);

    }

    /**
     *@Route("/update/{id}", name="update")
     * */

    public function update(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $quack = $entityManager->getRepository(Quack::class)->find($id);

        if (!$quack) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $quack->setContent("ZEUUUUUUUUUUUHHHH");
        $entityManager->flush();


        return $this->render('quack/updateQuack.html.twig', [
            'controller_name' => 'QuackController',
            'quack' => $quack
        ]);
    }

    /**
     *@Route("/delete/{id}", name="delete")
     * */

    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $quack = $entityManager->getRepository(Quack::class)->find($id);

        $deleteMessage = 'The quack n°'.$id.' was delete.';
        $entityManager->remove($quack);
        $entityManager->flush();

        return $this->render('quack/deleteQuack.html.twig', [
            'controller_name' => 'QuackController',
            'message' => $deleteMessage
        ]);

    }
}
