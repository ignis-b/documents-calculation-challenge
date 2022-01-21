<?php

namespace CalculationBundle\Controller;

use CalculationBundle\Entity\Invoices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CalculationBundle\Form\FileCsvUploadFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use CalculationBundle\Service\FileUploader;

class UploadFileController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, FileUploader $file_uploader) {
        $form = $this->createForm(FileCsvUploadFile::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['upload_file']->getData();

            $file_uploader->upload($file);
        }
        // Generate form.
        return $this->render('default/index.html.twig', [
         'form' => $form->createView(),
        ]);
    }

}
