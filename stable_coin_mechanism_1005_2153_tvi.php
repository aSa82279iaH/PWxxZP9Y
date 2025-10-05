<?php
// 代码生成时间: 2025-10-05 21:53:48
class StableCoinMechanism {

    /**
     * The exchange rate of the stable coin to the base currency.
     *
     * @var float
     */
    protected $exchangeRate;

    /**
     * The base currency code.
     *
     * @var string
     */
    protected $baseCurrency;

    /**
     * Create a new stable coin mechanism instance.
     *
     * @param float $exchangeRate
     * @param string $baseCurrency
     */
    public function __construct($exchangeRate, $baseCurrency) {
        $this->exchangeRate = $exchangeRate;
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * Converts the given amount of stable coins to base currency.
     *
     * @param float $stableCoinAmount
     * @return float
     * @throws Exception
     */
    public function convertToBaseCurrency($stableCoinAmount) {
        if ($stableCoinAmount <= 0) {
            throw new Exception('Stable coin amount must be greater than zero.');
        }

        return $stableCoinAmount * $this->exchangeRate;
    }

    /**
     * Converts the given amount of base currency to stable coins.
     *
     * @param float $baseCurrencyAmount
     * @return float
     * @throws Exception
     */
    public function convertToStableCoins($baseCurrencyAmount) {
        if ($baseCurrencyAmount <= 0) {
            throw new Exception('Base currency amount must be greater than zero.');
        }

        return $baseCurrencyAmount / $this->exchangeRate;
    }

    /**
     * Updates the exchange rate of the stable coin.
     *
     * @param float $newExchangeRate
     */
    public function updateExchangeRate($newExchangeRate) {
        $this->exchangeRate = $newExchangeRate;
    }

    /**
     * Gets the current exchange rate of the stable coin.
     *
     * @return float
     */
    public function getExchangeRate() {
        return $this->exchangeRate;
    }
}
