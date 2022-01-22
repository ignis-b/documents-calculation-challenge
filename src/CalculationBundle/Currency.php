<?php
    
namespace CalculationBundle;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Currency.
 */
class Currency
{
    protected static $currencies = [
        'EUR' => 1,
        'USD' => 1.13450,//0.987
        'GBP' => 0.878,
    ];
    
    /**
     * Get Currency exchange rate.
     *
     * @param string $currency
     * Currency
     *
     * @return float|NULL
     * Return rate
     */
    public function getRate($currency) {
        if (!in_array($currency, array_keys(self::$currencies))) {
            return NULL;
        }
        return self::$currencies[$currency];
    }
    
    /**
     * Get Money In Euro.
     *
     * @param string $money
     * Money.
     *
     * @param string $currency
     * Currency
     *
     * @return float|NULL
     * Return Converted Money in Euro.
     */
    public function getMoneyInEuro($money, $currency) {
        $rate = $this->getRate($currency);
        if ($rate == NULL) {
            return NULL;
        }
        return round(($money/$rate), 2);
    }
    
    /**
     * Get Euro Money In Other Currency.
     *
     * @param string $money
     * Money.
     *
     * @param string $currency
     * Currency
     *
     * @return float|NULL
     * Return Converted Money in Euro.
     */
    public function getMoneyInOtherCurrency($money, $currency) {
        $rate = $this->getRate($currency);
        if ($rate == NULL) {
            return NULL;
        }
        return round(($money*$rate), 2);
    }
}