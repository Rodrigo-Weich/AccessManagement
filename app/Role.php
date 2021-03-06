<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
