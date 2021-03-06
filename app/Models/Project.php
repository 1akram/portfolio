<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   protected $table='projects';
    use HasFactory;

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function techniques(){
        return $this->belongsToMany(Technique::class, 'techniques_users', 'project_id', 'technique_id');
    }

    public function haveImages(){
        return count($this->images) >0;
    }
}
