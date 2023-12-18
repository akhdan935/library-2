<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punish extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['user', 'punishment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function punishment()
    {
        return $this->belongsTo(Punishment::class);
    }
}
