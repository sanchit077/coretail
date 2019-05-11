<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
   protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

/////////////////////		Add New Social Account 		////////////////////////////

    public static function add_new_login_type($data)
	    {
	    	$social = new SocialAccount();

	    	$social->user_id            =   $data['user_id'];
	    	$social->provider_user_id   =   $data['provider_user_id'];
	    	$social->provider           =   $data['provider'];
	    	$social->created_at         =   new \DateTime;
	    	$social->updated_at         =   new \DateTime;

	    	$social->save();

	    	return $social;

	    }

//////////////////////		Update Login Updated At 	////////////////////////////

	   public static function update_login_type($id)
		   {
                    SocialAccount::whereId($id)->update([
                            'updated_at' => new \DateTime
                        ]);

		   }

//////////////////////
}
