<?php

/*
 * This file is part of the Regulator package, an OpenSky project.
 *
 * (c) 2011 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Regulator\Operator;

use Regulator\Context;
use Regulator\Value;
use Regulator\VariableOperand;

/**
 * A set min operator.
 *
 * @author Jordan Raub <jordan@raub.me>
 */
class Min extends VariableOperator implements VariableOperand
{
    public function prepareValue(Context $context): Value
    {
        /** @var VariableOperand $operand */
        [$operand] = $this->getOperands();

        return new Value($operand->prepareValue($context)->getSet()->min());
    }

    protected function getOperandCardinality()
    {
        return static::UNARY;
    }
}
