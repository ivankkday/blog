<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'personality','user_id',
    ];
    public function user()
    {
        // Profile 屬於 User (逆向關係)
        return $this->belongsTo('App\Models\User'); 
    }
}
