<?php

namespace App\Controller;

use App\Entity\Order;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/report/orders_report", name="orders_report", methods={"GET", "POST"})
     */
    public function ordersReport(Request $request, Pdf $knpSnappyPdf): Response
    {
        $result = [];
        $result = $this->getDoctrine()->getRepository(Order::class)->findAll();
        
        $html = $this->render('report/orders_report.html.twig', [
            'result' => $result,
        ]);

        $knpSnappyPdf->setOption('encoding', 'utf-8');
        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'Report.pdf',
        );
    }


}
