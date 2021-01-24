<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table='skills';
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
