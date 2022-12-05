<?php

namespace Denisok94\DoctrineDqlOperator\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class Cast
 * @package Denisok94\DoctrineDqlOperator\DQL
 * 
 * CAST(e.id AS integer) / CAST(e.id AS varchar)
 */
class Cast extends FunctionNode
{
    /** @var \Doctrine\ORM\Query\AST\PathExpression */
    protected $first;
    /** @var string */
    protected $second;

    /**
     * This tells Doctrine's Lexer how to parse the expression:
     * @param Parser $parser
     * @return void
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->first = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_AS);
        $parser->match(Lexer::T_IDENTIFIER);
        $this->second = $parser->getLexer()->token['value'];
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
            "CAST(%s AS %s)",
            $this->first->dispatch($sqlWalker),
            $this->second
        );
    }
}
