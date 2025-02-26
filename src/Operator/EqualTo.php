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
use Regulator\Proposition;
use Regulator\VariableOperand;

/**
 * An EqualTo comparison operator.
 *
 * @author Justin Hileman <justin@justinhileman.info>
 */
class EqualTo extends VariableOperator implements Proposition
{
    /**
     * @param Context $context Context with which to evaluate this Proposition
     */
    public function evaluate(Context $context): bool
    {
        /** @var VariableOperand $left */
        /** @var VariableOperand $right */
        [$left, $right] = $this->getOperands();

        return $left->prepareValue($context)->equalTo($right->prepareValue($context));
    }

    protected function getOperandCardinality()
    {
        return static::BINARY;
    }
}
