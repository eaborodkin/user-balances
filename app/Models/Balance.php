<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    public function operations()
    {
        return $this->hasMany(Operation::class)->orderByDesc('updated_at');
    }
}
