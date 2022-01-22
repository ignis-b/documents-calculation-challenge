<?php

namespace CalculationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;

class CalculatorForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('vat_number', TextType::class, ['required' => false])
            ->add('currencies', CurrencyType::class,
             ['data' => 'GBP']
            )
            ->add('invoice_type', ChoiceType::class, [
                'choices'  => [
                    '-select-' => 'null',
                    'invoice' => 1,
                    'credit note' => 2,
                    'debit note' => 3,
                ],
                'data' => 'null',
            ])
            ->add('submit', SubmitType::class, ['label' => 'Filter']);
    }
}