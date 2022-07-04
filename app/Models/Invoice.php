<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total_price',
    ];

    /**
     * Get all users that associated with this invoice.
     *
     * @return hasMany
     */
    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'invoiced_users')
            ->withTimestamps()
            ->withPivot(['invoice_for', 'sar', 'date']);
    }

    /**
     * Get all events that associated with this invoice.
     *
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(InvoicedEvent::class);
    }
}

