<?php

namespace Denisok94\DoctrineDqlOperator\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class DateTrunc
 * @package Denisok94\DoctrineDqlOperator\DQL
 * DateTrunc ::= "date_trunc" "(" ArithmeticPrimary "," ArithmeticPrimary ")"
 * 
 * DATE_TRUNC('month', e.created_dt) as month
 */
class DateTrunc extends FunctionNode
{
    public $firstDateExpression = null;
    public $secondDateExpression = null;

    /**
     * This tells Doctrine's Lexer how to parse the expression:
     * @param Parser $parser
     * @return void
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstDateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondDateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     *
     * This tells Doctrine how to create SQL from the expression - namely by (basically) keeping it as is:
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker): string
    {
        return sprintf(
            "DATE_TRUNC(%s, %s)",
            $this->firstDateExpression->dispatch($sqlWalker),
            $this->secondDateExpression->dispatch($sqlWalker)
        );
    }
}
