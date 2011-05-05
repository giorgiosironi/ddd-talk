<?php
namespace Type;

use Doctrine\DBAL\Types\Type,
    Doctrine\DBAL\Platforms\AbstractPlatform;

use Model\PaymentMethod;


class PaymentMethodType extends Type
{
    const PAYMENT_METHOD_TYPE = 'payment_method'; 
    const SEPARATOR = ',';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "VARCHAR(255)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value == '') {
            return null;
        }
        list ($name, $type) = explode(self::SEPARATOR, $value);
        return new PaymentMethod($name, $type);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return '';
        }
        return $value->getName() . self::SEPARATOR . $value->getType();
    }

    public function getName()
    {
        return self::PAYMENT_METHOD_TYPE; // modify to match your constant name
    }
}

