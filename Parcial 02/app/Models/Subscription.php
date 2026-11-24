<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo de contratación de servicios por usuario.
 */
class Subscription extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'started_at',
        'expires_at',
        'notes',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'date',
        'expires_at' => 'date',
    ];

    /**
     * Obtiene el usuario que contrató el servicio.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el servicio contratado.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Devuelve una etiqueta amigable para el estado contractual.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'activa' => 'Activa',
            'vencida' => 'Vencida',
            'cancelada' => 'Cancelada',
            default => 'Desconocido',
        };
    }
}
