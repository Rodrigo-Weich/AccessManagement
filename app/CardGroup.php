<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardGroup extends Model
{
    public function cards() {
        return $this->belongsToMany(Card::class);
    }
}
