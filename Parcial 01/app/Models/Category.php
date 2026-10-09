<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de categorías para clasificar publicaciones del blog.
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
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relación uno a muchos con publicaciones.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
