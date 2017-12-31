<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'name',
        'card_id',
        'due_on',
        'is_done',
        'order_key'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
