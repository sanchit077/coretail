<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Dec 2017 09:36:35 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
 
/**
 * Class Admin
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $job
 * @property string $admin_fee
 * @property string $timezone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Admin extends Authenticatable implements CanResetPasswordContract {

    use Notifiable,
        CanResetPassword ; 

    protected $guard = 'admin';
    protected $table = 'admin';
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'job',
        'admin_fee',
        'timezone'
    ];

    public function sendPasswordResetNotification($token) {
        $this->notify(new AdminResetPasswordNotification($token));
    }

//////////////////////////			Admin By Dynamic 		/////////////////////////////////////////////

    public static function return_by_dynamic($data) {
        return Admin::where($data['dynamic_column'], $data['dynamic_value'])->select('*')->first();
    }


      public static function create_new_admin($data) { 
        $user                =   new Admin();
        $user->name          =   isset($data['name']) ? $data['name'] : '';
        $user->email         =   isset($data['email']) ? $data['email'] : '' ;
        $user->job           =   isset($data['job']) ? $data['job'] : ''; 
        $user->profile_pic   =   isset($data['profile_pic']) ? $data['profile_pic'] : '';
        $user->password      =   isset($data['password']) ? \Hash::make($data['password']) : ''; 
        $user->created_at    =   new \DateTime;
        $user->updated_at    =   new \DateTime;

        $user->save(); 
        return $user; 
    }

///////////////////////////			Admin Update  			/////////////////////////////////////////////

    public static function admin_update($data, $admin) {

        return Admin::where('id', $admin->id)->update(array(
                    'name' => isset($data['name']) ? $data['name'] : $admin->name,
                    'job' => isset($data['job']) ? $data['job'] : $admin->job,
                    'profile_pic' => isset($data['profile_pic']) ? $data['profile_pic'] : $admin->profile_pic,
                    'timezone' => isset($data['timezone']) ? $data['timezone'] : $admin->timezone,
                    'email' => isset($data['email']) ? $data['email'] : $admin->email,
                    'password' => isset($data['password']) ? \Hash::make($data['password']) : $admin->password,
                    'updated_at' => new \DateTime
        ));
    }

///////////////////////////
}
