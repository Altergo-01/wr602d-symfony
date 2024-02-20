<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class PdfGeneratorService
{


    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {

        $this->httpClient = $httpClient;
    }

    public function urlPdf(string $pdfUrl): ?string
    {
        dump($pdfUrl);
        $filesystem = new Filesystem();



        $response = $this->httpClient->request(
            'POST',
            'http://gotenberg:3000/forms/chromium/convert/url',
            [
                'headers' => [
                    'Content-Type' => 'multipart/form-data',
                ],
                'body' => [
                    'url' => $pdfUrl,
                ],
            ]
        );

        $pdfFileName = uniqid('pdf_', true) . '.pdf';
        //$pdfFilePath = $request-> $request->getBasePath() . '/public/pdf/' . $pdfFileName;

        // Stockage du PDF généré
        //file_put_contents($pdfFilePath, $response->getContent());
        $filesystem->appendToFile($pdfFileName, $response->getContent());
        $path = Path::makeAbsolute('../public/pdf', '/wr602d-symfony/');
        dump($path, "on test");


        // Retourner le chemin du fichier PDF

        dump($pdfFileName, $response);

        return $response->getContent();
    }
}
