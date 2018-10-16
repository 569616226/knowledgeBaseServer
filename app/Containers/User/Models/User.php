<?php

namespace App\Containers\User\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Group\Models\Group;
use App\Containers\Menu\Models\Menu;
use App\Containers\Nav\Models\Nav;
use App\Ship\Parents\Models\UserModel;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends UserModel
{
    use AuthorizationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $guarded = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'device',
        'platform',
        'gender',
        'birth',
        'confirmed',
        'is_client',
        'is_frozen',
    ];

    protected $casts = [
        'is_client' => 'boolean',
        'is_frozen' => 'boolean',
        'confirmed' => 'boolean',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 修改认证时的默认username字段为tel
     */
    public function findForPassport($username) {
        return $this->where('name', $username)->first();
    }

    /*用户组*/
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function navs()
    {
        return $this->hasMany(Nav::class);
    }

    public function getMenusAttribute()
    {
        $roles = $this->roles;
        if ($roles->count() == 1) {
            $menus = $roles->first()->menus()->where('parent_id', 0)->get();
        } else {
            $menu_ids = [];
            foreach ($roles as $role) {
                $menu_ids = array_merge($menu_ids, $role->menus()->where('parent_id', 0)->get()->pluck('id')->toArray());
            }

            $menus = Menu::whereIn('id', $menu_ids)->get();
        }

        return $menus;
    }

}
