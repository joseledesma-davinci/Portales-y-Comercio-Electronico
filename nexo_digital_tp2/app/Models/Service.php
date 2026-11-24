<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de servicios comerciales ofrecidos por el estudio.
 */
class Service extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'synopsis',
        'description',
        'price',
        'image',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Obtiene las suscripciones vinculadas al servicio.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Retorna la URL de imagen aplicando fallback a placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('img/servicio-hosting.jpg');
        }

        return asset('img/'.$this->image);
    }
}
