<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Coach;
use App\Domains\Plans\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Gym extends Model
{
    use HasFactory;

    protected $table = 'gyms';

    protected $fillable = ['name', 'latitude', 'longitude', 'description'];

    public $timestamps = true;

    // protected static function booted()
    // {
    //     static::updating(function ($gym) {
    //         if ($gym->isDirty('name')) {
    //             // ('env.APP_NAME', $gym->name);
    //             // Config::set('app.name', $gym->name);
    //         }
    //     });
    // }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    public function coaches(): HasMany
    {
        return $this->hasMany(Coach::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function metaData()
    {
        return $this->query()->select([
            'id',
            'name',
            'description',
            'location',
        ])->first();
    }
}
