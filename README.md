# DoctrineDqlOperator

Add sql operator `date`, `cast`, `to_char`, `date_trunc` in doctrine

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
            timestamptz: Denisok94\DoctrineDqlOperator\DBAL\Timestamptz
            money: Denisok94\DoctrineDqlOperator\DBAL\MoneyType
    orm:
        dql:
            string_functions:
                DATE: Denisok94\DoctrineDqlOperator\DQL\Date
                CAST: Denisok94\DoctrineDqlOperator\DQL\Cast
                TO_CHAR: Denisok94\DoctrineDqlOperator\DQL\ToChar
                DATE_TRUNC: Denisok94\DoctrineDqlOperator\DQL\DateTrunc
```