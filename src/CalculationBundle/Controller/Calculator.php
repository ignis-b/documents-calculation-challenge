<?php

namespace CalculationBundle\Controller;

use CalculationBundle\Entity\Invoices;

use CalculationBundle\Form\CalculatorForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Calculator extends Controller
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function indexAction(Request $request) {
        $form = $this->createForm(CalculatorForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vat_number = $form['vat_number']->getData();
            //$this->addFlash('success', 'Results.');
        }
        // Generate form.
        return $this->render('default/calculator.html.twig', [
         'form' => $form->createView(),
        ]);
    }

}
