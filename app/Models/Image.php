<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{   protected $table='images';
    use HasFactory;
    protected $fillable = [
        'url',
     
    ];
    public function project()
    {
        return $this->belongsTo(project::class);
    }
}
