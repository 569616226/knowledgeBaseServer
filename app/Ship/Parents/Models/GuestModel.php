<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class GuestModel extends AbstractUserModel
{
    use HasRoles;
    use Notifiable;
    use HashIdTrait;
    use HasApiTokens;
    use HasResourceKeyTrait;


}
