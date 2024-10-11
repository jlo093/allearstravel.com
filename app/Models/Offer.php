<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $is_active
 * @property array<Rule> $rules
 */
class Offer extends Model
{
    use HasFactory;

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }
}
