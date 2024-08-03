<?php

namespace App\Domains\Club\Models;

use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Coach;
use App\Domains\Plans\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Gym extends Model
{
    use HasFactory;

    protected $table = 'gyms';

    protected $fillable = ['name', 'latitude','longitude', 'description'];

    public $timestamps = true;

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
