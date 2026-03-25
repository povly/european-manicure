<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Layouts\Casts\LayoutsCast;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $page): void {
            if (empty($page->slug)) {
                $page->slug = null;
            }
        });
    }

    protected function casts(): array
    {
        return [
            'content' => LayoutsCast::class,
        ];
    }
}
