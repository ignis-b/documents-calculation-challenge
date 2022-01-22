<?php

namespace CalculationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use CalculationBundle\Form\DataTransformer\StringToCurrencyTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorForm extends AbstractType
{
    private $transformer;
    
    public function __construct(StringToCurrencyTransformer $transformer) {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('vat_number', TextType::class)
            ->add('currencies', CurrencyType::class, [
//                [],
//                'preferred_choices' => ['GBR', 'arr']
            ])
            ->add('invoice_types', ChoiceType::class, [
                'choices'  => [
                    'invoice' => 1,
                    'credit note' => 2,
                    'debit note' => 3,
                ],
                'preferred_choices' => [1],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Filter']);
    }
}