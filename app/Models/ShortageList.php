<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortageList extends Model
{
    protected $table = 'shortage_list';

    protected $fillable = ['user_id' ,'instance', 'content'];

    protected $casts = [
        'content' => Json::class
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
