<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Validator;
//use Mail;
use View;
use Cookie;
use Redirect;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Input;
use DB, Auth;
use App\Http\Controllers\CommonController;
use Auth\AdminForgotPasswordController;
use Auth\AdminResetPasswordController;
use App\Models\Admin; 
use App\Models\User; 
use App\Models\UserDetail;  
use Illuminate\Validation\Rule;



class AdminController extends Controller {

    public static function admin_chat() { 
      return View::make('Admin.chat');
    }
    public static function showResetForm() {

        return View::make('Admin.passwords.email');
    }

//////////////		Admin Login Get 	////////////////////////////////////////////////////////////

    public static function admin_login_get() {
        $details = array();
        if (Cookie::get('ad_email') !== null) {
            $details['ad_email'] = Cookie::get('ad_email');
            $details['ad_psw'] = Cookie::get('ad_psw');
        }
        return View::make('Admin.Other.login')->with(compact('details'));
    }

//////////////		Admin Login Post 	////////////////////////////////////////////////////////////

    public static function admin_login_post(Request $request) {

       $remember = $request->get('remember');
        if (!$remember) {
            // Cookie::forget('ad_email');
            //Cookie::forget('ad_psw');
            Cookie::queue(\Cookie::forget('ad_email'));
        }
        try {
            $rules = array(
                'email' => 'required|email|exists:admin,email',
                'password' => 'required' );
                // ,'timezone' => 'required|timezone');
            $msg = array(
                    'email.required'    =>  __('login.email_required'),
                    'email.email'       =>  __('login.email'),
                    'email.exists'      =>  __('login.email_register'),
                    // 'password.required' =>  __('login.password_required'),
                    // 'timezone.required' =>  __('login.timezone_required'),
            );

            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->witherrors($validator->getMessageBag()->first())->withInput();

            $request['dynamic_column'] = 'email';
            $request['dynamic_value'] = $request['email'];
            $admin = Admin::return_by_dynamic($request);

            // if (!\Hash::Check($request['password'], $admin->password)){
            //     return Redirect::back()->witherrors(__('login.password_incorrect'))->withInput();
            // }
            if(is_object($admin)){
                if (\Hash::Check($request['password'], $admin->password)){
                    // $time = new \DateTime('now', new \DateTimeZone($request['timezone']));
                    // $request['timezonez'] = $time->format('P');
                    \Cookie::queue('adminid', $admin->id, 60);
                                                   
                    Auth::guard('admin')->login($admin);
                    Admin::admin_update($request, $admin);
                    if ($remember) {
                        Cookie::queue('ad_email', $request['email'], time() + (10 * 365 * 24 * 60 * 60));
                        Cookie::queue('ad_psw', $request['password'], time() + (10 * 365 * 24 * 60 * 60));
                    }
                    return Redirect::route('admin_dashboard')->with('successMsg',  __('login.login_success'));
                }
            } 
            return Redirect::back()->witherrors(__('login.password_incorrect'))->withInput(); 
            
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

///////////////////////////				Logout 			///////////////////////////////////////////////////////////

    public static function admin_logout() {
        try {
            \Cookie::queue('adminid', 0, 0);
            \Cookie::queue('adminRoleid', 0, 0);
            
            return Redirect::route('admin_login_get')->with('fresh', '1')->with('status', __('login.logout_success'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

///////////////////////////////////			Admin Dash Board 			////////////////////////////////////////

    public static function admin_dashboard(Request $request) { 
       // $starting_dt    = Carbon::now(\Session::get('timezonez'))->subMonths(2)->format('d/m/Y');
       // $ending_dt      = Carbon::now(\Session::get('timezonez'))->addday(1)->format('d/m/Y');
        /*  $request['starting_dt'] = $request['starting_dt'] . ' 00:00:00';
            $request['ending_dt'] = $request['ending_dt'] . ' 23:59:59';        */
     //   $data['starting_dt'] = '1970-01-01 00:00:00';
     //   $data['ending_dt'] = date('Y-m-d h:i:s', time());
        //$stats_data = AdminController::stats_data($data);
       // $graph_data = AdminController::new_graph_data($request);
      //  $data['user_id']='0';  
        return View::make('Admin.dashboard.index');
        //->with(compact('graph_data','stats_data', 'starting_dt', 'ending_dt' ));
    }

///////////////////////////////////			Dashboard Data 		////////////////////////////////////////////////

    public static function get_dashboard_data(Request $request) {
        try {
           /* $request['daterange'] = urldecode($request['daterange']);
            $temp_array = explode(' - ', $request['daterange']);

            $request['starting_dt'] = Carbon::CreateFromFormat('d/m/Y', $temp_array[0], \Session::get('timezonez'))->timezone('UTC')->format('Y-m-d');
            $request['ending_dt'] = Carbon::CreateFromFormat('d/m/Y', $temp_array[1], \Session::get('timezonez'))->timezone('UTC')->format('Y-m-d');

            $request['starting_dt'] = $request['starting_dt'] . ' 00:00:00';
            $request['ending_dt'] = $request['ending_dt'] . ' 23:59:59';

           */
            $stats_data = AdminController::stats_data($request);
            $graph_data = AdminController::new_graph_data($request);

            return Response(array('success' => '1', 'msg' => 'Dashboard Data', 'graph_data' => $graph_data,'stats_data'=>$stats_data), 200);
        } catch (\Exception $e) {
            return Response(array('success' => '0', 'msg' => $e->getMessage()), 200);
        }
    }

//////////////		Admin DashBoard Data		///////////////////////////////////////////////

    public static function stats_data($data) { 
        return DB::SELECT("SELECT
                IFNULL((SELECT COUNT(*) FROM users) , 0) as users_count,
                IFNULL((SELECT COUNT(*) FROM applications), 0) as applications_count,
                IFNULL((SELECT COUNT(*) FROM applications WHERE status = 'contract'), 0) as contracts_count,
                IFNULL((SELECT COUNT(*) FROM scheduled_calls  ), 0) as appointments_count 
                FROM admin LIMIT 0, 1 " 
            );


 //        return DB::SELECT("SELECT
	// (SELECT COUNT(*) FROM users WHERE  created_at BETWEEN :sdt1 AND :edt1 AND id != 0) as users_count FROM admin LIMIT 0, 1 ", 
 //                    [   'sdt1' => $data['starting_dt'], 'edt1' => $data['ending_dt'] 
 //        ]);
    }

//////		Graph Data 		//////////////////////////////////////////////////////////////////////////

    public static function new_graph_data($data) {  
        if(!isset($data['yr_only']))
            $yr_only = Carbon::now(\Session::get('timezonez'))->format('Y');
        else
            $yr_only  = $data['yr_only'];

	$querys = DB::SELECT("SELECT months_tbl.id as id,
	               
                CAST((SELECT COUNT(*) FROM users WHERE user_type='user' and YEAR(created_at) = :yr1 AND MONTH(created_at) = months_tbl.id AND id != 0) AS UNSIGNED) as users,
                
                CAST((SELECT COUNT(*) FROM applications WHERE  YEAR(created_at) = :yr2 AND MONTH(created_at) = months_tbl.id AND id != 0) AS UNSIGNED) as applications,
                
                CAST((SELECT COUNT(*) FROM applications WHERE status='contract' and YEAR(created_at) = :yr3 AND MONTH(created_at) = months_tbl.id AND id != 0) AS UNSIGNED) as contracts,

                CAST((SELECT COUNT(*) FROM scheduled_calls WHERE  YEAR(created_at) = :yr4 AND MONTH(created_at) = months_tbl.id AND id != 0) AS UNSIGNED) as appointments


             FROM months_tbl",['yr1'=>$yr_only, 'yr2'=>$yr_only, 'yr3'=>$yr_only, 'yr4'=>$yr_only]);

            $users          =   array();
            $applications   =   array();
            $contracts      =   array();
            $appointments   =   array();  

            foreach($querys as $query)
            {
                array_push($users, $query->users); 
                array_push($applications, $query->applications); 
                array_push($contracts, $query->contracts); 
                array_push($appointments, $query->appointments); 
            }

		return array('users'=>$users, 'applications'=>$applications, 'contracts'=>$contracts, 'appointments'=>$appointments,'dt'=>$yr_only);
         
    }

//////////////////		Admin Profile Update Get ////////////////////////////////////////////////////////////

    public static function aprofile_update_get() {
        try {

            return View::make('Admin.Other.profileupdate');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

//////////////		Admin Profile Update Post ////////////////////////////////////////////////////////////

    public static function aprofile_update_post() {
        try {

            $data = Input::all();
            $rules = array(
                'name' => 'required',
                'job' => 'required',
                'profile_pic' => 'image',
            );
            $msg = [
                'name.required'     => __('admin_dashboard.name_required')  ,
                'job.required'      => __('admin_dashboard.job_required')  ,
                'profile_pic.image' => __('admin_dashboard.profile_img')  ,
            ];

            $validator = Validator::make($data, $rules, $msg );
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $admin = \App('admin');

            if (!empty($data['profile_pic'])) {
                $filename = CommonController::image_uploader(Input::file('profile_pic'));
                if (empty($filename))
                    return Redirect::back()->witherrors(__('admin_dashboard.image_u_error'));
            } else
                $filename = $admin->profile_pic;

            DB::table('admin')->where('id', 1)->update(array(
                'name'          => $data['name'],
                'job'           => $data['job'],
                'profile_pic'   => $filename,
                'updated_at'    => new \DateTime
            ));

            return Redirect::back()->with('status', __('admin_dashboard.profile_u_success'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

/////////////		Admin Password Update Get  //////////////////////////////////////////////////////

    public static function apassword_update_get() {
        try {
            return View::make('Admin.Other.passwordupdate');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    public static function apassword_update_get_role() {
        try {
            return View::make('Admin.Other.passwordupdate_role');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
//////////////		Admin Password Update post  //////////////////////////////////////////////////////

    public static function apassword_update_post() {
        try {
            $data = Input::all();
            $rules = array('old_password' => 'required', 'password' => 'required|confirmed');
            $msg = [
                'old_password.required'     => __('admin_dashboard.old_p')  ,
                'password.required'         => __('login.password_required')   ,
                'password.confirmed'        => __('admin_dashboard.pass_c_notmatch')    ,
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $admin = \App('admin');

            if (!\Hash::check($data['old_password'], $admin->password))
                return Redirect::back()->withErrors( __('admin_dashboard.old_p_wrong'));

            DB::Table('admin')->where('id', $admin->id)->update(array(
                'password' => \Hash::make($data['password']),
                'updated_at' => new \DateTime
            ));

            return Redirect::Back()->with('status',  __('admin_dashboard.pass_u_success'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

    public static function apassword_update_post_role() {
        try {
            $data = Input::all();
            $rules = array('old_password' => 'required', 'password' => 'required|confirmed');
            $msg = [
                'old_password.required'     => __('admin_dashboard.old_p')  ,
                'password.required'         => __('login.password_required')   ,
                'password.confirmed'        => __('admin_dashboard.pass_c_notmatch')    ,
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $admin = \App('admin');

            if (!\Hash::check($data['old_password'], $admin->password))
                return Redirect::back()->withErrors( __('admin_dashboard.old_p_wrong'));

            DB::Table('users')->where('id', $admin->id)->update(array(
                'password' => \Hash::make($data['password']),
                'updated_at' => new \DateTime
            ));

            return Redirect::Back()->with('status',  __('admin_dashboard.pass_u_success'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

    //////////////////      Admin Profile Update Get ////////////////////////////////////////////////////////////

    public static function aprofile_update_get_role() {
        try { 
            $roles = Role::pluck("name","id");  
            $role_array = array(); 
            $admin = \App('admin');
            $user_role  = $admin->getRoleNames();
            $role_array = array();
            foreach ($user_role as $key => $value) {
                $role_array[] = $value;
            }
            return View::make('Admin.Other.profileupdate_role')->with(compact('role_array','roles'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

//////////////      Admin Profile Update Post ////////////////////////////////////////////////////////////

    public static function aprofile_update_post_role() {
        try {

            $rules = array( 
                'name'          =>  'required|max:150',   
                'email'         =>  'bail|nullable|unique:users,email,' . $request->id . ',id',
                'phone'         =>  'bail|nullable|numeric|unique:users,phone,' . $request->id . ',id', 
                //'phone'       =>  'unique:users',
                'role'         =>  "required",
                    Rule::in(['superadmin','admin','user','credit_analyst','branch_manager','account_executive','customer_support']), 
                'password'      =>  'nullable|min:6|max:50',
                'profile_pic'   =>  'image',
                'latitude'      =>  'required',
                'longitude'     =>  'required',
                'address'       =>  'required'
            );
            $msg=array(
              /*  'address.required'        =>  'Business address is required.',
                'latitude.required'         =>  'Please choose a valid address.',
                'longitude.required'        =>  'Please choose a valid address.',*/
                'profile_pic.image'         =>  __('admin_dashboard.profile_img') // 'Profile picture should be a valid image.'
            );
            $validator = Validator::make($request->all(), $rules,$msg);
            if ($validator->fails())
                return Redirect::back()->witherrors($validator->getMessageBag()->first())->withInput();

            $admin = \App('admin'); 
            $user_details       = UserDetail::where('user_id',$admin->id)->first();
            if (!empty($request['profile_pic'])) {
                 $data['profile_pic'] = CommonController::image_uploader(Input::file('profile_pic'));
                if (empty($data['profile_pic']))
                    return Redirect::back()->witherrors(__('admin_dashboard.image_u_error'));
            } else
                   $data['profile_pic'] = $user_details->profile_pic;
            $data['user_id']    = $admin->id;
            User::update_user_admin($data,$admin);
            
           // $user->removeRole($user->role);             
            //$user->assignRole($request->role); 
            // All current roles will be removed from the user and replaced by the array given
           $user->syncRoles([$request->role]);

            
            UserDetail::update_user_admin($data,$user_details);    
            return Redirect::back()->with('status', __('admin_dashboard.profile_u_success'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

}
