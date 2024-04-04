<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_log_id', 'message', 'turns'];

    public function userLog()
    {
        return $this->belongsTo(UserLog::class);
    }

    public function messages()
{
    return $this->hasMany(Message::class); // Replace Message::class with the actual name of your Message model
}
}
