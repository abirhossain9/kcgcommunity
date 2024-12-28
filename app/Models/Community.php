<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public $timestamps = true;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
