<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\PdfGeneratorService;
use Symfony\Component\HttpFoundation\Request;


class PdfGeneratorController extends AbstractController
{

    private PdfGeneratorService $pdfGeneratorService;

    public function __construct( PdfGeneratorService $pdfGeneratorService ) {
       $this->pdfGeneratorService = $pdfGeneratorService;

    }

    #[Route('/pdf/generator', name: 'app_pdf_generator')]
    public function new(Request $request): Response
    {

        $form = $this->createFormBuilder()
            ->add('url', TextType::class)
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $url = $form->get('url')->getData();
            $pdfContent = $this->pdfGeneratorService->urlPdf($url);

            return new Response($pdfContent, 200,['Content-type'=>'application/pdf']);
        }


        return $this->render('pdf_generator/index.html.twig', [
            'controller_name' => 'PdfGeneratorController',
            'form' => $form,

        ]);
    }
}
