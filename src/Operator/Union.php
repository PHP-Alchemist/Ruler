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
use Regulator\Set;
use Regulator\Value;
use Regulator\VariableOperand;

/**
 * A Set Union Operator.
 *
 * @author Jordan Raub <jordan@raub.me>
 */
class Union extends VariableOperator implements VariableOperand
{
    public function prepareValue(Context $context): Value
    {
        $union = new Set([]);
        /** @var VariableOperand $operand */
        foreach ($this->getOperands() as $operand) {
            $set   = $operand->prepareValue($context)->getSet();
            $union = $union->union($set);
        }

        return $union;
    }

    protected function getOperandCardinality()
    {
        return static::MULTIPLE;
    }
}
