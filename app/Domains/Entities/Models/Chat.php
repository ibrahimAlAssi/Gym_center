<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    public $timestamps = true;

    public function messages()
    {
        return $this->hasMany('Message', 'chat_id');
    }
}
