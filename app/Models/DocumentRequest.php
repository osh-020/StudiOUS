<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'subject',
        'purpose',
        'additional_notes',
        'delivery_method',
        'payment_proof',
        'scanned_copy',
        'rejection_reason',
        'priority',
        'status',
        'country',
        'region',
        'province',
        'city',
        'barangay',
        'postal_code',
        'street_details',
        'delivery_address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTicketIdAttribute(): string
    {
        return 'REQ-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}
