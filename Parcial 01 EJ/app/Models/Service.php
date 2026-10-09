<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de servicios ofrecidos por el estudio.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $category
 * @property string $short_description
 * @property string $description
 * @property float $price
 * @property string $billing_cycle
 * @property string $features
 * @property bool $included_support
 * @property bool $featured
 * @property bool $active
 */
class Service extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'short_description',
        'description',
        'price',
        'billing_cycle',
        'features',
        'included_support',
        'featured',
        'active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'included_support' => 'boolean',
        'featured' => 'boolean',
        'active' => 'boolean',
    ];
}
