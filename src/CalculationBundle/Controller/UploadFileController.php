<?php

namespace CalculationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CalculationBundle\Form\FileCsvUploadForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use CalculationBundle\Service\FileUploader;

/**
 * Controller for inserting csv file
 * data in Database.
 *
 * @author I <ignis.b@gmail.com>
 */
class UploadFileController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, FileUploader $file_uploader) {
        $form = $this->createForm(FileCsvUploadForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileData = $form['upload_file']->getData();

            $file_uploader->setData($fileData);
            $this->addFlash('success', 'The file has been uploaded successfully!');
        }
        // Generate form.
        return $this->render('default/index.html.twig', [
         'form' => $form->createView(),
        ]);
        
    }

}
