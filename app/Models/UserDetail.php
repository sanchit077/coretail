<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
	protected $table = 'user_details';
	protected $timestamp = true;

    public $fillable = ['first_name', 'last_name',   'user_id', 'profile_pic',    'latitude', 'longitude', 'fcm_id', 'timezone','device_type'
    ];
    public function user(){ 
       return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
    public static function save_userDetails($data) { 
        $userDetails          			= 	new UserDetail();
        $userDetails->user_id     		= 	$data['user_id']; 
        $userDetails->first_name    	= 	isset($data['first_name']) ? $data['first_name'] : null ; 
        $userDetails->last_name    		= 	isset($data['last_name']) ? $data['last_name'] : null;  

		$userDetails->profile_pic    	= 	isset($data['profile_pic']) ? $data['profile_pic'] : null;
        $userDetails->device_type       =   isset($data['device_type']) ? $data['device_type'] : 'web';  
        $userDetails->latitude    	    = 	isset($data['latitude']) ? $data['latitude'] : null;
		$userDetails->longitude    		= 	isset($data['longitude']) ? $data['longitude'] : null;
		$userDetails->fcm_id    		= 	isset($data['fcm_id']) ? $data['fcm_id'] : null;
		$userDetails->timezone    		= 	isset($data['timezone']) ? $data['timezone'] : null;     

        $userDetails->save(); 
        return $userDetails; 
    }

       public static function update_user_admin($data, $userDetails)
        {
          	UserDetail::whereId($userDetails->id)
            ->limit(1)
            ->update([ 

            'latitude' 				=> isset($data['latitude']) ? $data['latitude'] : $userDetails->latitude,
            'longitude' 			=> isset($data['longitude']) ? $data['longitude'] : $userDetails->longitude,
            'profile_pic'			=> isset($data['profile_pic']) ? $data['profile_pic'] : $userDetails->profile_pic, 
            'first_name'  			=> 	isset($data['first_name']) ? $data['first_name'] : $userDetails->first_name ,
            'last_name'   			=> 	isset($data['last_name']) ? $data['last_name'] : $userDetails->last_name,
            'device_type'           =>  isset($data['device_type']) ? $data['device_type'] : $userDetails->device_type,
            'fcm_id'    			=> 	isset($data['fcm_id']) ? $data['fcm_id'] : $userDetails->fcm_id,          	
            'timezone'    			=> 	isset($data['timezone']) ? $data['timezone'] : $userDetails->timezone,    
            'updated_at' 			=>	new \DateTime
            ]); 
             
        }

      public static function update_deviceType_fcm($data, $user_details)
        {
                UserDetail::where('user_id',$user_details->user_id)
                ->limit(1)
                ->update([
                    'fcm_id'        => isset($data['fcm_id']) ? $data['fcm_id'] : $user_details->fcm_id, 
                    'device_type'   => isset($data['device_type']) ? $data['device_type'] : $user_details->device_type, 
                    'updated_at'    => new \DateTime
                ]);        
        }
}
