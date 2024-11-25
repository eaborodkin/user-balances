<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Casts\NumberCast;
use App\Models\Traits\CustomQueryBuilder;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    use HasFactory;
    use Filterable;
    use CustomQueryBuilder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'description',
    ];

    protected $casts = [
        'amount' => NumberCast::class,
    ];

    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
