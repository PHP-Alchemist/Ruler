<?php

/*
 * This file is part of the Ruler package, an OpenSky project.
 *
 * (c) 2011 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ruler\Operator;

use Ruler\Context;
use Ruler\Set;
use Ruler\Value;
use Ruler\VariableOperand;

/**
 * A Set Intersection Operator.
 *
 * @author Jordan Raub <jordan@raub.me>
 */
class Intersect extends VariableOperator implements VariableOperand
{
    public function prepareValue(Context $context): Value
    {
        $intersect = null;
        /** @var VariableOperand $operand */
        foreach ($this->getOperands() as $operand) {
            if (!$intersect instanceof Set) {
                $intersect = $operand->prepareValue($context)->getSet();
            } else {
                $set       = $operand->prepareValue($context)->getSet();
                $intersect = $intersect->intersect($set);
            }
        }

        return $intersect;
    }

    protected function getOperandCardinality()
    {
        return static::MULTIPLE;
    }
}
