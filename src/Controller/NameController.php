<?php

namespace App\Controller;

use App\Entity\Name;
use App\Form\NameType;
use App\Repository\NameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/name")
 */
class NameController extends AbstractController
{
    /**
     * @Route("/", name="name_index", methods={"GET"})
     */
    public function index(NameRepository $nameRepository): Response
    {
        return $this->render('name/index.html.twig', [
            'names' => $nameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="name_show", methods={"GET"})
     */
    public function show(Name $name): Response
    {
        return $this->render('name/show.html.twig', [
            'name' => $name,
        ]);
    }
}
