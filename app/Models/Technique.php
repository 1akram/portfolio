<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{   protected $table='techniques';
    use HasFactory;

    public function projects(){
        return $this->belongsToMany(Project::class, 'techniques_users', 'technique_id', 'project_id');
    }
}
