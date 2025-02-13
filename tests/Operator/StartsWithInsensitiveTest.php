<?php

namespace Ruler\Test\Operator;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Operator;
use Ruler\Variable;

class StartsWithInsensitiveTest extends TestCase
{
    public function testInterface()
    {
        $varA = new Variable('a', 'foo bar baz');
        $varB = new Variable('b', 'foo');

        $op = new Operator\StartsWith($varA, $varB);
        $this->assertInstanceOf(\Ruler\Proposition::class, $op);
    }

    #[DataProvider('startsWithData')]
    public function testStartsWithInsensitive($a, $b, $result)
    {
        $varA = new Variable('a', $a);
        $varB = new Variable('b', $b);
        $context = new Context();

        $op = new Operator\StartsWithInsensitive($varA, $varB);
        $this->assertEquals($op->evaluate($context), $result);
    }

    public static function startsWithData()
    {
        return [
            ['supercalifragilistic', 'supercalifragilistic', true],
            ['supercalifragilistic', 'super', true],
            ['supercalifragilistic', 'SUPER', true],
            ['supercalifragilistic', 'stic', false],
            ['supercalifragilistic', '', false],
        ];
    }
}
