<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Layouts\Casts\LayoutsCast;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'content' => LayoutsCast::class,
        ];
    }

    public static function getBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }
}
