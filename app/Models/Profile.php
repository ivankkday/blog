<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'personality','flower_id',
    ];
    public function flower()
    {
        // Profile 屬於 Flower (逆向關係)
        return $this->belongsTo('App\Models\Flower'); 
    }
}
