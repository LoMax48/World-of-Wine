<?php

namespace App\Controller;

use App\Entity\Name;
use App\Entity\Order;
use App\Entity\Contains;
use App\Form\NameType;
use App\Form\ContainsType;
use App\Repository\NameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

/**
 * @Route("/name")
 */
class NameController extends AbstractController
{
    private $session;



    /**
     * @Route("/", name="name_index", methods={"GET","POST"})
     */
    public function index(NameRepository $nameRepository, Security $security, Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('cart')) {
            $session->set('cart', []);
        }
        
        return $this->render('name/index.html.twig', [
            'names' => $nameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="name_show", methods={"GET","POST"})
     */
    public function show(Request $request, Name $name, Security $security): Response
    {
        $session = $request->getSession();
        $contains = new Contains();
        $form = $this->createForm(ContainsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $session->get('cart');
            
            $number =  $form['number']->getData();
            if(key_exists($name->getId(), $cart)) {
                $cart[$name->getId()] += (int)$number;
            }
            else {
                $cart[$name->getId()] = (int)$number;
            }
            
            $session->set('cart', $cart);

            return $this->redirectToRoute('name_index');
        }
        
        return $this->render('name/show.html.twig', [
            'name' => $name,
            'contains_form' => $form->createView(),
        ]);
    }
}
