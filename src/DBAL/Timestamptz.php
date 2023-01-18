<?php

namespace Denisok94\DoctrineDqlOperator\DBAL;

use DateTime;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Timestamp type for the Doctrine 2 ORM
 */
class Timestamptz extends Type
{
    /**
     * Type name
     * @var string
     */
    const TIMESTAMPTZ = 'timestamptz';

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TIMESTAMPTZ;
    }

    /**
     * @inheritDoc
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TIMESTAMPTZ';
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof DateTime) {
            return $value->format($this->getDateTimeTzFormatString());
        }

        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getName(),
            ['null', 'DateTime']
        );
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $val = DateTime::createFromFormat($this->getDateTimeTzFormatString(), $value);
        if ($val === false) {
            $val = DateTime::createFromFormat('Y-m-d H:i:s+O', $value);
            if ($val === false) {
                throw ConversionException::conversionFailedFormat(
                    $value,
                    $this->getName(),
                    $this->getDateTimeTzFormatString(),
                );
            }
        }

        return $val;
    }

    public function getDateTimeTzFormatString()
    {
        return 'Y-m-d H:i:s.u O';
    }
}
