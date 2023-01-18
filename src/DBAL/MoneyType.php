<?php

namespace Denisok94\DoctrineDqlOperator\DBAL;

use Denisok94\DoctrineDqlOperator\DBAL\Money;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * https://stackoverflow.com/questions/27300447/symfony-money-field-type-and-doctrine
 */
class MoneyType extends Type
{
    const MONEY = 'money';

    public function getName()
    {
        return self::MONEY;
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'MONEY';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // list($value, $currency) = sscanf($value, 'MONEY(%f %d)');
        $value = str_replace(['$', ','], '', $value);
        return new Money($value, $currency = "");
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Money) {
            $value = sprintf('MONEY(%F %D)', $value->getValue(), $value->getCurrency());
        }
        return $value;
    }

    public function canRequireSQLConversion()
    {
        return true;
    }

    /**
     * @param string           $sqlExpr
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToPHPValueSQL($sqlExpr, $platform)
    {
        // return sprintf('AsText(%s)', $sqlExpr);
        return sprintf('%s', $sqlExpr);
    }

    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return sprintf('PointFromText(%s)', $sqlExpr);
        // return $sqlExpr;
    }
}
