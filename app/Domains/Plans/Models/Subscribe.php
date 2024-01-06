<?php

namespace App\Domains\Plans\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribe';

    public $timestamps = true;

    public function plan()
    {
        return $this->hasOne('}Models\Plan', 'plan_id');
    }

    public function admin()
    {
        return $this->hasOne('App\Domains\Entities\Models\Admin', 'coach_id');
    }

    public function offer()
    {
        return $this->hasOne('App\Domains\Entities\Models\Offer', 'offer_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Domains\Plans\Models\Payment', 'subscribe_id');
    }
}
