<?php

namespace App\Containers\Menu\Models;

use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Models\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'icon',
        'url',
        'description',
        'is_nav',
        'order',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_nav' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'menus';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getChildrenAttribute()
    {

       return  Menu::where('parent_id',$this->id)->get();
    }
}
