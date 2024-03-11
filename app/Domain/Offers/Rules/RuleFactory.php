<?php

namespace App\Domain\Offers\Rules;

use Exception;

class RuleFactory
{
    /**
     * @param string $class
     * @return OrderRule|RateRule
     *
     * @throws Exception
     */
    public function getRuleClass(string $class): OrderRule|RateRule
    {
        return match ($class) {
            RateHasMinimumMargin::class => new RateHasMinimumMargin(),
            default => throw new Exception('Could not resolve rule into rule class.'),
        };
    }
}
