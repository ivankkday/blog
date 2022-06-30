<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [          // 使用批量分配（ Mass Assignment ）的填充白名單
        'name', 'email', 'password', 'api_token'
    ];

    protected $hidden = [           // 隱藏 model 的陣列或 JSON 的屬性 
        'password',
    ];

    public function profile()
    {
        // 每個 User 都有 Profile（正向關係）
        return $this->hasOne('App\Models\Profile'); 
    }

    public function post()
    {
        // 每種 users 有數種 nutrients
        // 締結 單一 User 對 多 Nutrient 的關係(正向)
        return $this->hasMany('App\Models\Post');
    }

    public function Comment(){

        return $this->hasMany('App\Models\Comment');
    }
}
