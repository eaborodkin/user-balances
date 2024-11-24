<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Casts\NumberCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balance extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => NumberCast::class,
    ];

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
}
