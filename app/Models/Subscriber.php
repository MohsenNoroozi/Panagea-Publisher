<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
