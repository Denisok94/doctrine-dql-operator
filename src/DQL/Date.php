<?php

namespace Denisok94\DoctrineDqlOperator\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class Date
 * @package Denisok94\DoctrineDqlOperator\DQL
 */
class Date extends FunctionNode
{
    public $date;

    /**
     * This tells Doctrine's Lexer how to parse the expression:
     * @param Parser $parser
     * @return void
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->date = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * This tells Doctrine how to create SQL from the expression - namely by (basically) keeping it as is:
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker): string
    {
        return sprintf(
            "DATE(%s)",
            $sqlWalker->walkArithmeticPrimary($this->date)
        );
    }
}
