<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['punishes'];

    public function punishes()
    {
        return $this->hasMany(Punish::class);
    }
}
