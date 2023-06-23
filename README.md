# DoctrineDqlOperator

- Add sql operator `date, cast, to_char, date_trunc, extract, JSONB_AG, JSONB_HGG, JSONB_EX, JSONB_IN` in doctrine
- Add sql types `timestampt, timestamptz, money` in doctrine

## Installation

Run:

```bash
composer require --prefer-dist denisok94/doctrine-dql-operator
# or
php composer.phar require --prefer-dist denisok94/doctrine-dql-operatorr
```

or add to the `require` section of your `composer.json` file:

```json
"denisok94/doctrine-dql-operator": "*"
```

```bash
composer update
# or
php composer.phar update
```

## Use

```yaml
# ~config/packages/doctrine.yaml
doctrine:
    dbal:
        types:
            timestampt: Denisok94\DoctrineDqlOperator\DBAL\Timestampt
            timestamptz: Denisok94\DoctrineDqlOperator\DBAL\Timestamptz
            money: Denisok94\DoctrineDqlOperator\DBAL\MoneyType
    orm:
        dql:
            datetime_functions:
                DATE: Denisok94\DoctrineDqlOperator\DQL\Date
                DATE_TRUNC: Denisok94\DoctrineDqlOperator\DQL\DateTrunc
                EXTRACT: Denisok94\DoctrineDqlOperator\DQL\Extract
            string_functions:
                CAST: Denisok94\DoctrineDqlOperator\DQL\Cast
                TO_CHAR: Denisok94\DoctrineDqlOperator\DQL\ToChar
                TO_CHAR_S: Denisok94\DoctrineDqlOperator\DQL\ToCharS
                JSONB_AG: Denisok94\DoctrineDqlOperator\DQL\JsonbAtGreater
                JSONB_HGG: Denisok94\DoctrineDqlOperator\DQL\JsonbHashGreaterGreater
                JSONB_EX: Denisok94\DoctrineDqlOperator\DQL\JsonbExistence
                JSONB_IN: Denisok94\DoctrineDqlOperator\DQL\JsonbIndex
```

```php

use Doctrine\ORM\Mapping as ORM;
use Denisok94\DoctrineDqlOperator\DBAL\Money;

class Entity
{
    /**
     * @ORM\Column(type="money")
     * @var Money|null
     */
    protected $budget;

    /**
     * @ORM\Column(type="timestampt")
     * @var \DateTime|null
     */
    protected $created_at;

    /**
     * @ORM\Column(type="timestamptz")
     * @var \DateTime|null
     */
    protected $updated_at;
}
```
