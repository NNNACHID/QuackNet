<?php

namespace App\Controller;

use App\Entity\Quack;
use App\Repository\QuackRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function create(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $quack = new Quack();

        $quack->setContent("WAZAAAAAA");
        $quack->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($quack);
        $entityManager->flush();

        return $this->render('quack/createQuack.html.twig', [
            'controller_name' => 'QuackController',
            'quack' => $quack
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
     *@Route("/delete", name="delete")
     * */

    public function delete(): Response
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
}
