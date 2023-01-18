<?php

namespace Denisok94\DoctrineDqlOperator\DBAL;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 *  https://stackoverflow.com/questions/27300447/symfony-money-field-type-and-doctrine
 * 
 * ```php
 * class Order
 * {
 *  // Column(type="money")
 *  // var Money
 *  protected $money;
 *  public function setMoney(Money $money): void
 *  {
 *      $this->money = $money;
 *  }
 *  public function getMoney(): Money
 *  {
 *      return $this->money;
 *  }
 * }
 * $order = new Order();
 * $order->setMoney(new Money(99.95, 'EUR'));
 * ```
 */
class Money
{
    /**
     * @var float|null
     * @Serializer\Type("float")
     * @Serializer\Groups({"money_value"})
     */
    public $value;

    /**
     * @var string|null
     * @Serializer\Type("string")
     * @Serializer\Groups({"money_currency"})
     */
    public $currency;

    /**
     * @param float $value
     * @param string $currency
     */
    public function __construct($value, $currency)
    {
        $this->value  = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    public function __toString()
    {
        return $this->value . $this->currency;
    }
}
