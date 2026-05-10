<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'subject',
        'category',
        'priority',
        'status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getTicketIdAttribute(): string
    {
        $prefix = $this->category === 'Document Request' ? 'REQ' : 'TKT';

        return $prefix . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}
