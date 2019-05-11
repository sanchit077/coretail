<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Validator,
    Hash,
    DateTime,
    Mail,
    DB,
    Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\SocialAccount;
   
use Redirect;
use App\Http\Controllers\CommonController as GCommonController;


class UserController extends Controller {

//////////////////////////////		User Register 		/////////////////////////////////////////////
    /**
     *
     * User Register
     *
     * 	 @SWG\Post(
     *     path="/user/signUp",
     *     tags={"User Register & Login Section"},
     *     consumes={"multipart/form-data"},
     *     description="User Registeration",
     *   	@SWG\Parameter(
     *     		name="name",
     *     		in="formData",
     *     		description="Full Name",
     *     		required=true,
     *     		type="string"
     *   	),
     *   	@SWG\Parameter(
     *     		name="email",
     *     		in="formData",
     *     		description="Email",
     *     		required=true,
     *     		type="string"
     *   	),
     *      @SWG\Parameter(
     *          name="password",
     *          in="formData",
     *          description="Password",
     *          required=true,
     *          type="string"
     *      ),
     *     @SWG\Parameter(
     *          name="type",
     *          in="formData",
     *          description="1 for landloard, 2 for brand owner and 3 for both",
     *          required=true, 
     *          type="string"
     *      ), 
     *      @SWG\Parameter(
     *          name="device_type",
     *          in="formData",
     *          description="Device type like 'web', 'android', 'ios'", 
     *          required=false,
     *          type="string"
     *      ), 
     *     @SWG\Parameter(
     *     		name="timezone",
     *     		in="formData",
     *     		description="TimeZone Eg - Asia/Kolkata",
     *     		required=false,
     *     		type="string"
     *   	),
     *   	@SWG\Parameter(
     *     		name="latitude",
     *     		in="formData",
     *     		description="Latitude",
     *     		required=false,
     *     		type="string"
     *   	),
     *   	@SWG\Parameter(
     *     		name="longitude",
     *     		in="formData",
     *     		description="Longitude",
     *     		required=false,
     *     		type="string"
     *   	),   	
     *   	@SWG\Parameter(
     *     		name="fcm_id",
     *     		in="formData",
     *     		description="FCM ID for push notifications",
     *     		required=false,
     *     		type="string"
     *   	),
     *     @SWG\Response(response=200, description="Success"),
     *     @SWG\Response(response=400, description="Validation Error"),
     *     @SWG\Response(response=500, description="Api Error")
     * )
     *
     * User SignUp
     *
     * @return \Illuminate\Http\Response
     */
    public static function app_register(Request $request) {
        try {

            $validation = Validator::make($request->all(), [
                        'name'      => 'bail|required',
                        'email'     => 'bail|required|email|unique:users,email', 
                        'password'  => 'bail|required|min:6' 
                      //,'timezone' => 'bail|required|timezone'
                            ]
            );
            if ($validation->fails()) {
                return response(array('success' => 0, 'statuscode' => 400, 'msg' =>
                    $validation->getMessageBag()->first()), 400);
            }

            $data = $request->all();
            $data['password']   = trim($request['password'], '"');

            if(isset($request->type) && $request->type==1){
                $data['landlord']      = '1';
                $data['brandOwner']    = '0';
            }elseif(isset($request->type) && $request->type==2){
                $data['landlord']      = '0';
                $data['brandOwner']    = '1';      
            }elseif(isset($request->type) && $request->type==3){
                $data['landlord']      = '1';
                $data['brandOwner']    = '1';
            }else{
                $data['landlord']      = '0';
                $data['brandOwner']    = '0';
            }

            $userdata = User::create_new_user($data); 
            $data['user_id'] = $userdata->id;
            UserDetail::save_userDetails($data); 
            Auth::loginUsingId($userdata->id); 

            $user = User::get_user_profile($data); 
            $user->token = $user->createToken('coretail')->accessToken;
            return response(['success' => 1, 'statuscode' => 200, 'msg' => __('signup.signup_success'), 'result' => ['user' => $user]], 200);
        } catch (\Exception $e) {
            return response(['success' => 0, 'statuscode' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
 
    //////////////////////////////      User Register       /////////////////////////////////////////////
    /**
     *
     * User Social Login
     *
     *   @SWG\Post(
     *     path="/user/verifySocialAccount",
     *     tags={"User Social Login Section"},
     *     consumes={"multipart/form-data"},
     *     description="User Social Login",
     *      @SWG\Parameter(
     *          name="name",
     *          in="formData",
     *          description="Full Name",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          in="formData",
     *          description="Email",
     *          required=false,
     *          type="string"
     *      ),  
      @SWG\Parameter(
     *          name="provider_user_id",
     *          in="formData",
     *          description="Socail Media Unique ID",
     *          required=true,
     *          type="string"
     *      ),
      @SWG\Parameter(
     *          name="provider",
     *          in="formData",
     *          description="Social Media Name like google, facebook",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="device_type",
     *          in="formData",
     *          description="Device type like 'web', 'android', 'ios'", 
     *          required=false,
     *          type="string"
     *      ), 
      @SWG\Parameter(
     *          name="timezone",
     *          in="formData",
     *          description="TimeZone Eg - Asia/Kolkata",
     *          required=false,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="latitude",
     *          in="formData",
     *          description="Latitude",
     *          required=false,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="longitude",
     *          in="formData",
     *          description="Longitude",
     *          required=false,
     *          type="string"
     *      ),      
     *      @SWG\Parameter(
     *          name="profile_pic",
     *          in="formData",
     *          description="Profile Picture",
     *          required=false,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="fcm_id",
     *          in="formData",
     *          description="FCM ID for push notifications",
     *          required=false,
     *          type="string"
     *      ),     
     *     @SWG\Response(response=200, description="Success"),
     *     @SWG\Response(response=400, description="Validation Error"),
     *     @SWG\Response(response=500, description="Api Error")
     * )
     *
     * User SignUp
     *
     * @return \Illuminate\Http\Response
     */
    public static function app_social_login(Request $request) {
        try {
            /* Checking for previous records start */
            $extstingUser = $extstingSocial = [];
            if (isset($request->email) && !empty($request->email)) {
                $extstingUser = User::with('social_accounts')
                        ->where('email', $request->email)
                        ->get();
            } else {
                $extstingSocial = SocialAccount::with('user')
                        ->where('provider_user_id', $request->provider_user_id)
                        ->where('provider', $request->provider)
                        ->get();
            }
            if (count($extstingUser) > 0 && count($extstingUser[0]->social_accounts) > 0) {
                $social_accounts = $extstingUser[0]->social_accounts;
                SocialAccount::firstOrCreate(
                        ['provider_user_id' => $request->provider_user_id, 'provider' => $request->provider, 'user_id' => $extstingUser[0]->id]
                );
                //    $userData = User::where('id', $extstingUser[0]->id)->first();
                $data['user_id'] = $extstingUser[0]->id;

                DB::table('users')
                ->where('id', $data['user_id'])
                ->update(['login_from' => $request->provider]);

                $userData = User::get_user_profile($data); 
                Auth::loginUsingId($userData->id); 

                $user = User::get_user_profile($data); 
                $user->token = $user->createToken('coretail')->accessToken;


            $userDetails            =  UserDetail::where('user_id',$userData->id)->first();
            $data['fcm_id']         = !empty(request('fcm_id')) ? request('fcm_id') : ''; 
            $data['device_type']    = !empty(request('device_type')) ? request('device_type') : 'web'; 
            UserDetail::update_deviceType_fcm($data, $userDetails);


                return response(['success' => 1, 'statuscode' => 200, 'msg' => __('signup.register_user_msg'), 'result' => ['user' => $user]], 200);
            } else if (count($extstingSocial) > 0 ) { 
                //&& count($extstingSocial[0]->user) > 0
                $data['user_id'] = $extstingSocial[0]->user->id;
                DB::table('users')
                ->where('id', $data['user_id'])
                ->update(['login_from' => $request->provider]);

                $userData = User::get_user_profile($data);  
                Auth::loginUsingId($userData->id);  

                $user = User::get_user_profile($data); 
                $user->token = $user->createToken('coretail')->accessToken;


            $userDetails            =  UserDetail::where('user_id',$userData->id)->first();
            $data['fcm_id']         = !empty(request('fcm_id')) ? request('fcm_id') : ''; 
            $data['device_type']    = !empty(request('device_type')) ? request('device_type') : 'web'; 
            UserDetail::update_deviceType_fcm($data, $userDetails);


                return response(['success' => 1, 'statuscode' => 200, 'msg' => __('signup.register_user_msg'), 'result' => ['user' => $user]], 200);
            }

            /* Checking for previous records end */


            $validation = Validator::make($request->all(), [
                        'name' => 'bail|required',
                        'provider_user_id' => 'bail|required|unique:social_accounts,provider_user_id',
                        'provider' => 'bail|required',
                        'email' => 'bail|email|unique:users,email'
                     //   ,'timezone' => 'bail|required|timezone'
                            ], [
                        'email.unique' => __('signup.email_exist'),
                        'provider.required' => __('Provider_required'),
                        'provider_user_id.required' => __('Provider_user_required'),
                        'provider_user_id.unique' => __('Provider_unique')
                            ]
            );
            if ($validation->fails()) {
                return response(array('success' => 0, 'statuscode' => 400, 'msg' =>
                    $validation->getMessageBag()->first()), 400);
            }

            $data = $request->all(); 
            $user_d = User::create_new_user($data); 
            $data['user_id'] = $user_d->id;
            UserDetail::save_userDetails($data); 
            $socialData = SocialAccount::add_new_login_type($data);
             DB::table('users')
            ->where('id',  $user_d->id)
            ->update(['login_from' => $request->provider]);

            $userData = User::get_user_profile($data); 
            Auth::loginUsingId($userData->id);  

            $user = User::get_user_profile($data); 
            $user->token = $user->createToken('coretail')->accessToken;


            $userDetails            =  UserDetail::where('user_id',$userData->id)->first();
            $data['fcm_id']         = !empty(request('fcm_id')) ? request('fcm_id') : ''; 
            $data['device_type']    = !empty(request('device_type')) ? request('device_type') : 'web'; 
            UserDetail::update_deviceType_fcm($data, $userDetails);

            return response(['success' => 1, 'statuscode' => 200, 'msg' => __('signup.signup_success'), 'result' => ['user' => $user ]], 200);
        } catch (\Exception $e) {
            return response(['success' => 0, 'statuscode' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    /**
     *
     * User Login
     *
     *   @SWG\Post(
     *     path="/user/login",
     *     tags={"User Register & Login Section"},
     *     consumes={"multipart/form-data"},
     *     description="User Login",
     *      @SWG\Parameter(
     *          name="email",
     *          in="formData",
     *          description="Email",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="formData",
     *          description="Password",
     *          required=true,
     *          type="string"
     *      ), 
     *      @SWG\Parameter(
     *          name="fcm_id",
     *          in="formData",
     *          description="FCM ID for Push Notifications",
     *          required=false,
     *          type="string"
     *      ),
     *      @SWG\Parameter(
     *          name="device_type",
     *          in="formData",
     *          description="Device type like 'web', 'android', 'ios'", 
     *          required=false,
     *          type="string"
     *      ), 
            @SWG\Parameter(
     *          name="timezone",
     *          in="formData",
     *          description="TimeZone Eg - Asia/Kolkata",
     *          required=false,
     *          type="string"
     *      ),     
     *     @SWG\Response(response=200, description="Success"),
     *     @SWG\Response(response=400, description="Validation Error"),
     *     @SWG\Response(response=500, description="Api Error")
     * )
     *
     * User SignUp
     *
     * @return \Illuminate\Http\Response
     */
    public function app_login() { 

            $user = User::where('email',request('email'))->first();
            if(!$user)
                return Response(array('success'=>0, 'statuscode'=>400, 'msg'=> 'Lo sentimos, este usuario no está registrado con nosotros.'),400);
            elseif( !Hash::check(request('password'),$user->password) )
                return Response(array('success'=>0,'statuscode'=>400,'msg'=>'Lo siento esta contraseña es incorrecta.'),400);         
            $request['user_id'] = $user->id;

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {          
            $data['user_id'] = Auth::user()->id;
            $user = User::get_user_profile($data); 
            DB::table('users')
                ->where('id', $user->id)    
                ->update(['login_from' => 'custom']);

            $userDetails            =  UserDetail::where('user_id',$data['user_id'])->first();
            $data['fcm_id']         = !empty(request('fcm_id')) ? request('fcm_id') : ''; 
            $data['device_type']    = !empty(request('device_type')) ? request('device_type') : 'web'; 
            UserDetail::update_deviceType_fcm($data, $userDetails);


            $user->token = $user->createToken('coretail')->accessToken;
            return response(['success' => 1, 'statuscode' => 200,
                'msg' => __('signup.Login_success'), 'result' => ['user' => $user ]], 200);
        } else { 
            return response(['success' => 0, 'statuscode' => 500, 'msg' => __('signup.Login_fail')], 500);
        }
    }
 
//////////////////////////////		App Logout 		/////////////////////////////////////////////////
    /**
     *
     * User Logout
     *
     * 	 @SWG\Post(
     *     path="/user/logout",
     *     tags={"User Register & Login Section"},
     *     consumes={"multipart/form-data"},
     *     description="User Logout",
     *     security={
     *         {
     *             "default": "Bearer "
     *         }
     *     },
     *     @SWG\Response(response=200, description="Success"),
     *     @SWG\Response(response=400, description="Validation Error"),
     *     @SWG\Response(response=500, description="Api Error"),
     *     @SWG\Response(response=401, description="Unauthorized")
     * )
     *
     * User Logout
     *
     * @return \Illuminate\Http\Response
     */
    public static function app_logout(Request $request) {
        try {

            $user = Auth::user();
            Auth()->user()->token()->revoke();
            
            User::whereId($user->id)
                    ->limit(1)
                    ->update([
                      //  'fcm_id' => '',
                        'updated_at' => new \DateTime
            ]);
            return response(['success' => 1, 'statuscode' => 200, 'msg' => __('signup.logout_success')], 200);
        } catch (\Exception $e) {
            return response(['success' => 0, 'statuscode' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
 }
