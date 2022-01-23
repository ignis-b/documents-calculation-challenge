<?php

namespace Tests\CalculationBundle\Units;

use CalculationBundle\Currency;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CurrencyTest extends WebTestCase
{
    public function testIndex() {
        $currency = new Currency();
        
        $this->assertEquals(0.878, $currency->getRate('GBP'));
    }
}

