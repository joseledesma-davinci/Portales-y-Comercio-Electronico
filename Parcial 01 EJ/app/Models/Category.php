<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de categorías para organizar artículos del blog.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property-read Collection<int, Post> $posts
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Obtiene las publicaciones asociadas a la categoría.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
