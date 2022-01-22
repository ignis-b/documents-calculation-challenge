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

        if ($form->isSubmitted() && $form->isValid()) {
            $data = [];
            
            if (!empty($form['vat_number']->getData())) {
                $data['vatNumber'] = $form['vat_number']->getData();
            }
            $type = ($form['invoice_type']->getData() != 'null') ? $form['invoice_type']->getData() : '';

            $documents = $this
                ->getDoctrine()
                ->getRepository(Invoices::class)
                ->findBy($data);

            return $this->render("default/calculator.html.twig", [
             'form' => $form->createView(),
             'documents' => $this->getTotal($documents, $type, $form['currencies']->getData())
            ]);
        }
        // Generate form.
        return $this->render('default/calculator.html.twig', [
            'form' => $form->createView(),
            'documents' => []
        ]);
    }
    
    /**
     * Get Total.
     *
     * @param array $documents
     * Documents.
     *
     * @param int $type
     * Type.
     *
     * @param string $currency
     * Type.
     *
     * @return array
     * Total.
     */
    private function getTotal($documents, $type, $srCurrency) {
        $data = [];
        $results = [];
        $currency =  new Currency();
        foreach ($documents as $document) {
            // Total in Euro.
            $total = $currency->getMoneyInEuro($document->getTotal(), $document->getCurrency());
            // Update total for specific customer.
            if (
                in_array($document->getVatNumber(), array_keys($data)) &&
                in_array($document->getType(), array_keys($data[$document->getVatNumber()]))
            ) {
                $total = $total + $data[$document->getVatNumber()][$document->getType()];
            }
            // Generate array by Vat and type[invoice, debit, credit].
            $data[$document->getVatNumber()][$document->getType()] = $total;
        }
        foreach ($data as $key => $value) {
            switch ($type) {
                case 1:
                    $total = $value[$type];
                    break;
                case 2:
                    // Credit.
                    $total = $value[1] - $value[$type];
                    break;
                case 3:
                    // Debit.
                    $total = $value[1] + $value[$type];
                    break;
                default:
                    $total = array_sum(array_values($value));
            }
            $results[$key]['customer'] = $key;
            $results[$key]['total'] = $currency->getMoneyInOtherCurrency($total, $srCurrency) . ' ' . $srCurrency;
        }
        return $results;
    }
}
