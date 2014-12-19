<?php

namespace SS6\ShopBundle\Model\Pricing\Currency;

use SS6\ShopBundle\Component\Validator;
use SS6\ShopBundle\Model\Pricing\Currency\Currency;

/**
 * @Validator\Auto(entity="SS6\ShopBundle\Model\Pricing\Currency\Currency")
 */
class CurrencyData {

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $code;

	/**
	 * @var string
	 */
	private $symbol;

	/**
	 * @var string
	 */
	private $exchangeRate;

	/**
	 * @param string|null $name
	 * @param string|null $code
	 * @param string|null $symbol
	 * @param string $exchangeRate
	 */
	public function __construct($name = null, $code = null, $symbol = null, $exchangeRate = Currency::DEFAULT_EXCHANGE_RATE) {
		$this->name = $name;
		$this->code = $code;
		$this->symbol = $symbol;
		$this->exchangeRate = $exchangeRate;
	}

	/**
	 * @return string|null
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string|null
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @return string|null
	 */
	public function getSymbol() {
		return $this->symbol;
	}

	/**
	 * @return string
	 */
	public function getExchangeRate() {
		return $this->exchangeRate;
	}

	/**
	 * @param string|null $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string|null $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @param string|null $symbol
	 */
	public function setSymbol($symbol) {
		$this->symbol = $symbol;
	}

	/**
	 * @param string $exchangeRate
	 */
	public function setExchangeRate($exchangeRate) {
		$this->exchangeRate = $exchangeRate;
	}

	/**
	 * @param \SS6\ShopBundle\Model\Pricing\Currency\Currency $currency
	 */
	public function setFromEntity(Currency $currency) {
		$this->name = $currency->getName();
		$this->code = $currency->getCode();
		$this->symbol = $currency->getSymbol();
		$this->exchangeRate = $currency->getExchangeRate();
	}

}