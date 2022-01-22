<?php
    
namespace CalculationBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\ORM\EntityManagerInterface;

class StringToCurrencyTransformer implements DataTransformerInterface
{
    private $manager;
    
    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }
    
    /**
     * Transforms a String (currency_str) to a Currency
     *
     * @param String|null $currency_str
     * @return Currency The Currency Object
     * @throws UnknownCurrencyException if Currency is not found
     */
    public function transform($currency_str) {
        if (null === $currency_str) {
            return;
        }
        try {
            $currency = new Currency($currency_str);
        } catch (UnknownCurrencyException $ex) {
            throw new TransformationFailedException(
             sprintf(
              'The currency "%s" does not exist', $currency_str
             ));
        }
        return $currency;
    }
    
    /**
     * Transforms a Currency (currency) to a String
     * @param Currency $currency
     * @return String|null The ISO code of the currency
     * @throws TransformationFailedException if currency is not found
     */
    public function reverseTransform($currency) {
        // if no currency provided
        if (!$currency) {
            return;
        }
        $currency_str = $currency->getName();
        return $currency_str;
    }
    
}