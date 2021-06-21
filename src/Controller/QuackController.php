<?php

namespace App\Controller;

use App\Entity\Quack;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;

class QuackController extends AbstractController
{
    /**
     * @Route("/quack", name="quack")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $Quack = new Quack();

        $Quack->setContent('Quaaaaack');
        $Quack->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($Quack);
        $entityManager->flush();


        return $this->render('quack/index.html.twig', [
            'controller_name' => 'QuackController',
        ]);
    }
    public function read(): Response
    {

    }
    public function update(): Response
    {

    }
    public function delete(): Response
    {

    }
}
