<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{

    protected $fillable = [
        'name',
        'card_id',
        'due_on',
        'is_done',
        'order_key'
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
