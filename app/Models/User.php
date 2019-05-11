<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Hash,    DateTime,    DB;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPassword;
use Laravel\Passport\HasApiTokens;
use App\Models\SocialAccount;

class User extends Authenticatable implements MustVerifyEmail {
   use HasApiTokens, Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'phone', 'latitude', 'longitude', 'timezone', 'fcm_id', 'lang','login_from'
    ];


    //////////////////////////          User By Dynamic        /////////////////////////////////////////////

    public static function return_by_dynamic($data) {
        return User::where($data['dynamic_column'], $data['dynamic_value'])->select('*')->first();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      	'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetails(){
       return $this->hasOne(\App\Models\UserDetail::class);
    }

    public function social_accounts() {
        return $this->hasMany(\App\Models\SocialAccount::class, 'user_id');
    }

    ///////////////////////////			Insert User 		///////////////////////////////////////////

    public static function create_new_user($data) {
        $user           	= new User();
        $user->name     	= $data['name'];
        $user->email    	= isset($data['email']) ? $data['email'] : null ;
       	$user->landlord    	= isset($data['landlord']) ? $data['landlord'] : '0' ;
      	$user->brandOwner   = isset($data['brandOwner']) ? $data['brandOwner'] : '0' ;
        $user->password 	= isset($data['password']) ? Hash::make($data['password']) : '';
        $user->created_at 	= new \DateTime;
        $user->updated_at 	= new \DateTime;
        $user->save();
        return $user;
    }

    /////////////////////////       Get User profile        ////////////////////////////

    public static function get_user_profile($data) {
        $user = User::whereId($data['user_id']);
        $user->select('*' ,DB::Raw('(select count(*) from social_accounts sa where sa.user_id=users.id) as total_social'),
            DB::Raw('(CASE  WHEN landlord = "1"  && brandOwner = "1"
                                THEN 3
                            WHEN landlord = "0" && brandOwner = "1"
                                THEN 2
                            ELSE 1  END
                    ) as type')
    );
        $user->with(['userDetails' => function($query) {
            $query->select('*', DB::RAW("(COALESCE(profile_pic,'')) as profile_pic"),

                DB::RAW("(CASE WHEN profile_pic IS NULL THEN '' WHEN profile_pic LIKE 'http%' THEN profile_pic ELSE CONCAT('" . env('UPLOAD_IMAGE_URL') . "',profile_pic) END) as profile_pic_url")
            );
        }]);
        $user = $user->first();
        return $user;
    }



/////////////////////////       Update User Password    /////////////////////////////

    public static function update_user_password($data)
        {
            User::whereId($data['user_id'])
            ->limit(1)
            ->update([
                'password' => $data['new_password'],
                'updated_at' => new \DateTime
            ]);

        }
/////////////////////////       Update User Password    /////////////////////////////

    public static function create_user_password($data)
        {
            User::whereId($data['user_id'])
            ->limit(1)
            ->update([
                'password' => $data['new_password'],
                'updated_at' => new \DateTime
            ]);

        }

/////////////////////////       Update Profile      //////////////////////////////////

    public static function update_profile($data, $user)
        {
         $user=   User::whereId($user->id)
            ->limit(1)
            ->update([
                    'name' => isset($data['name'])?$data['name']:$user->name,
                    'email' =>isset($data['email'])?$data['email']:$user->email ,
                    'phone' => isset($data['phone']) ? $data['phone'] : NULL,
                  //  'profile_pic' => isset($data['profile_pic']) ? $data['profile_pic'] : $user->profile_pic,
                    'updated_at' => new \DateTime
            ]);
             return $user;
        }

/////////////////////////       Update User Fcm         ///////////////////////////////



/////////////////////////
         public static function update_user_admin($data, $user)
        {
            User::whereId($user->id)
            ->limit(1)
            ->update([
                    'name' => $data['name'],
                    'email' => isset($data['email']) ? $data['email'] : NULL,
                    'password'=> isset($data['password']) ? Hash::make($data['password']) : $user->password,
                    'phone' => isset($data['phone']) ? $data['phone'] : NULL,
                   /* 'badges' => isset($data['badges']) ? $data['badges'] : 0,
                    'flat_no' => isset($data['flat_no']) ? $data['flat_no'] : NULL,
                    'address' => isset($data['address']) ? $data['address'] : NULL,
                    'latitude' => isset($data['latitude']) ? $data['latitude'] : NULL,
                    'longitude' => isset($data['longitude']) ? $data['longitude'] : NULL,
                    'profile_pic' => isset($data['profile_pic']) ? $data['profile_pic'] : $user->profile_pic,*/
                    'updated_at' => new \DateTime
            ]);

        }

        public function sendPasswordResetNotification($token)
        {
            $this->notify(new CustomResetPassword($token));
        }



}
