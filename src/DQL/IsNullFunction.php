<?php

namespace App\DBAL\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class IsNullFunction
 *
 * @package App\DBAL\Functions
 */
class IsNullFunction extends FunctionNode
{
    /** @var \Doctrine\ORM\Query\AST\PathExpression */
    public $value = null;

    /**
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker): string
    {

        return sprintf(
            'COALESCE(%s, 0)', // ISNULL not sapor pgsql
            $this->value->dispatch($sqlWalker)
        );
    }

    /**
     * @throws QueryException
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->value = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
