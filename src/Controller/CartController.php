<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Contains;
use App\Entity\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Request $request): Response
    {
        $cartSession = $request->getSession()->get('cart');
        $cartItems = [];
        $entityManager = $this->getDoctrine()->getManager()->getRepository(Name::class);
        $sumPrice = 0;
        foreach ($cartSession as $wineId => $wineNumber) {
            $wine = $entityManager->findOneBy(['id' => $wineId]);
            $price = $wine->getPrice() * $wineNumber;
            $cartItems[] = [
                'wineName' => $wine->getName(),
                'wineNumber' => $wineNumber,
                'price' => $price
            ];
            $sumPrice += $price;
        }
        return $this->render('cart/index.html.twig', [
            'cartItems' => $cartItems,
            'sumPrice' => $sumPrice,
        ]);
    }

    /**
     * @Route("/makeOrder", name="makeOrder")
     */
    public function makeOrder(Request $request, Security $security): Response
    {
        $cartSession = $request->getSession()->get('cart');
        $user = $security->getUser();

        $order = new Order();
        $order->setDateTime(new \DateTime());
        $order->setIsConfirmed(false);
        $order->setClient($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);

        $entityManagerWine = $this->getDoctrine()->getManager()->getRepository(Name::class);

        foreach ($cartSession as $wineId => $wineNumber) {
            $wine = $entityManagerWine->findOneBy(['id' => $wineId]);
            $contains = new Contains();
            $contains->setBooking($order);
            $contains->setName($wine);
            $contains->setNumber($wineNumber);
            $entityManager->persist($contains);
        }

        $entityManager->flush();

        return $this->redirectToRoute('name_index');
    }
}
