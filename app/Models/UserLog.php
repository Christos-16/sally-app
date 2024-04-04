<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
protected $fillable = ['action', 'user_id', 'new_column1', 'new_column2', 'no_of_words'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

