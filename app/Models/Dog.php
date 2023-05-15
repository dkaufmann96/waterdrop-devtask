<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'data'];

    protected $casts = [
        'data' => 'json'
    ];

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => json_decode($value, true),
        );
    }
}
