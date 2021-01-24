<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table='social_media';
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
