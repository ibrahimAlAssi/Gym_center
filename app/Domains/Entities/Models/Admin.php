<?php

namespace App\Domains\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = ['role_id', 'name', 'phone', 'email', 'description'];

    public function role()
    {
        return $this->belongsTo('App\Domains\Entities\Models\Admin');
    }

    public function chats()
    {
        return $this->hasMany('Chat', 'admin_id');
    }
}
