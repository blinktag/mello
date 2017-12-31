<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
