<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 04 Apr 2018 09:13:43 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserNotification
 * 
 * @property int $id
 * @property int $user_id
 * @property int $driver_id
 * @property int $admin_id
 * @property int $ride_id
 * @property string $message
 * @property string $type
 * @property string $is_read
 * @property string $deleted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Driver $driver
 * @property \App\Models\Admin $admin
 * @property \App\Models\Ride $ride
 *
 * @package App\Models
 */
class UserNotification extends Model
{
	protected $casts = [
		'user_id' => 'int', 
		'admin_id' => 'int',
		'app_id' => 'int'
	];

	protected $fillable = [
		'user_id', 
		'admin_id',
		'app_id',
		'message',
		'type',
		'is_read',
		'deleted'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
 

	public function admin()
	{
		return $this->belongsTo(\App\Models\Admin::class);
	}

	public function application()
	{
		return $this->belongsTo(\App\Models\Application::class);
	}
			/////////////		usernotification Insert 	//////////////////////////////////////


	public static function insert_data($data)
		{
			$usernot = new UserNotification(); 
            $usernot->user_id	 	= 	$data['user_id'];
			$usernot->admin_id 		= 	isset($data['admin_id']) ? $data['admin_id'] : 1;			
			$usernot->app_id 		= 	$data['app_id'];
			$usernot->message 		= 	$data['message'];
			$usernot->type 			= 	$data['type'];			
			$usernot->is_read 		= 	isset($data['is_read']) ? $data['is_read'] : 0;			
			$usernot->deleted 		=	isset($data['deleted']) ? $data['deleted'] : 0;
			$usernot->save();
			return $usernot->id;

		}
    /////////////		usernotification //////////////////////////////////////
}
