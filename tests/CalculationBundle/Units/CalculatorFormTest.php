<?php
    
namespace Tests\CalculationBundle\Units;

use Symfony\Component\Form\Test\TypeTestCase;
use CalculationBundle\Form\CalculatorForm;
use CalculationBundle\Entity\Invoices;

class CalculatorFormTest extends TypeTestCase
{
    /**
     * @test
     */
    public function formSubmitsValidData() {
        $formData = [
            'vat_number' => 123456789,
            'currency' => 'GBP',
            'type' => 1
        ];

        $documentComparedToForm = new Invoices();
        $documentComparedToForm
            ->setVatNumber($formData['vat_number'])
            ->setCurrency($formData['currency'])
            ->setType($formData['type']);
    
        $documentHandledByForm = new Invoices();
    
        $form = $this->factory->create(CalculatorForm::class, $documentHandledByForm);
    
        $form->submit($formData);
    
        static::assertTrue($form->isSynchronized());
        static::assertEquals($documentComparedToForm, $documentHandledByForm);

        $view = $form->createView();

        foreach (array_keys($formData) as $key) {
            static::assertArrayHasKey($key, $view->children);
        }
    }
}