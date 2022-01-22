<?php

namespace CalculationBundle\Controller;

use CalculationBundle\Form\CalculatorForm;
use CalculationBundle\Entity\Invoices;
use CalculationBundle\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for invoice calculation.
 *
 * @author I <ignis.b@gmail.com>
 */
class Calculator extends Controller
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function indexAction(Request $request) {
        $form = $this->createForm(CalculatorForm::class);
        $form->handleRequest($request);
    
        $currency =  new Currency();
        $a = $currency->getMoneyInEuro(5, 'USD');

        $a = $currency->getMoneyInOtherCurrency(5, 'USD');

        if ($form->isSubmitted() && $form->isValid()) {
            $vat_number = $form['vat_number']->getData();

            $invoices = $this
                ->getDoctrine()
                ->getRepository(Invoices::class)
                ->findBy(
                    ['vatNumber' => $vat_number]
                );

            return $this->render("default/calculator.html.twig", [
             'form' => $form->createView(),
             'invoices' => $invoices
            ]);
        }
        // Generate form.
        return $this->render('default/calculator.html.twig', [
            'form' => $form->createView(),
            'invoices' => []
        ]);
    }

}
