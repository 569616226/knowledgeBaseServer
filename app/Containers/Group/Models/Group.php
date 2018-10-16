<?php

namespace App\Containers\Group\Models;

use App\Containers\Guest\Models\Guest;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'groups';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class);
    }
}
