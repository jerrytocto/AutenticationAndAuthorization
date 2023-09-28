<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Blog extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable=[
        'user_id', 'title','content'
    ];

    //Un blog pertenece a un solo usaurio 
    public function user(){
        return $this->belongsTo(User::class);
    }
}
