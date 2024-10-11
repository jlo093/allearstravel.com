<?php

namespace App\Models;

use App\Domain\Offers\Rules\OrderRule;
use App\Domain\Offers\Rules\RateRule;
use App\Domain\Offers\Rules\RuleFactory;
use App\Traits\HasSerialisedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * @property string $rule_type
 * @property array $payload
 */
class Rule extends Model
{
    use HasFactory;

    protected $casts = [
        'payload' => 'array'
    ];

    public function isApplicable(?Order $order = null, ?\App\Services\RateHawk\Responses\DTO\Rate $rate = null): bool
    {
        try {
            $rule = (new RuleFactory())
                ->getRuleClass($this->rule_type);

            if (in_array(HasSerialisedData::class, class_uses($rule))) {
                $rule->loadSerialisedData($this->payload);
            }

            if ($rule instanceof OrderRule && $order) {
                return $rule->isApplicable($order);
            } else if ($rule instanceof RateRule && $rate) {
                return $rule->isApplicable($rate);
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return false;
        }
    }
}
