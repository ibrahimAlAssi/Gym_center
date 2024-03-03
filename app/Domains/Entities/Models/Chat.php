<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';

    public $timestamps = true;

    public function messages()
    {
        return $this->hasMany('Message', 'chat_id');
    }
}
