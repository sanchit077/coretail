<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use View;
use Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use App\Http\Controllers\CommonController;
 
use App\Models\Admin; 
use App\Models\User;
use App\Models\UserDetail; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 

class AdminUserController extends Controller
{
    //////////////// 		All Users     /////////// ///// 
    public static function admin_user_all(Request $request) {  
        try { 
            $users = User::select('*',DB::Raw('(select count(*) from social_accounts sa where sa.user_id=users.id) as total_social') )->where('user_type','user')->paginate(10);
                //where('status', 'active')->
           
            return View::make('Admin.User.allusers')->with('users', $users);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_user_delete(Request $request, $id = null) {
        try {
            $user = User::findorfail($id);
            $user->delete(); 
            return Redirect::back()->with('status', __('admin_user.user_delete_s'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
////////////////////Category Block Unblock 	////////////////////////////////////////////////////
    public static function admin_user_block(Request $request, $id = null, $status = null) {
        try {
            $user = User::findorfail($id);

            if ($status == 1) {

                if ($user->status == 'block')
                    return Redirect::back()->withErrors(__('admin_user.user_a_block'))->withInput();

                DB::Table('users')->where('id', $user->id)->update(array(
                    'status' => 'block',
                    'updated_at' => new \DateTime
                ));

                return Redirect::back()->with('status', __('admin_user.user_block'));
            }
            else {
                if ($user->status == 'active')
                    return Redirect::back()->withErrors(__('admin_user.user_a_unblock'))->withInput();

                DB::Table('users')->where('id', $user->id)->update(array(
                    'status' => 'active',
                    'updated_at' => new \DateTime
                ));

                return Redirect::back()->with('status', __('admin_user.user_unblock'));
            }
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_user_add_get(){
        try {
            $roles = Role::pluck("name","id");  
            $role_array = array();
            return View::make('Admin.User.adduser')->with(compact('role_array','roles'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    public static function admin_user_add_post(Request $request){
        try {
            $rules = array( 
                'name'          =>  'required|max:150',                
                'email'         =>  'required|unique:users,email|max:150',
                'phone'         =>  'numeric|unique:users',
                'password'      =>  'required|min:6|max:50',
                'role'         =>  "required",
                    Rule::in(['superadmin','admin','user','credit_analyst','branch_manager','account_executive','customer_support']),   
                'profile_pic'   =>  'image',
                'latitude'      =>  'required',
                'longitude'     =>  'required',
                'address'       =>  'required'
            );
            $msg    =   array(
                /*'address.required'          =>  'Business address is required.',
                'latitude.required'         =>  'Please choose a valid address.',
                'longitude.required'        =>  'Please choose a valid address.',
                'profile_pic.image'         =>  'Profile picture should be a valid image.'*/
                'profile_pic.image'         =>  __('admin_dashboard.profile_img') 
            );
            $validator = Validator::make($request->all(), $rules,$msg);
            if ($validator->fails())
                return Redirect::back()->witherrors($validator->getMessageBag()->first())->withInput();
            $data = $request->all();
            if (!empty($request->profile_pic)) {
                $filename = CommonController::image_uploader(Input::file('profile_pic'));

                if (empty($filename))
                    return Redirect::back()->witherrors( __('admin_dashboard.image_u_error'));

                $data['profile_pic'] = $filename;
            }
            $user = User::create_new_user($data);
            $data['user_id'] = $user->id;
            $user->assignRole($request->role); //'guard_name' => 'admin'
            $user_details = UserDetail::save_userDetails($data);
            //$user->removeRole('writer');
            return Redirect::back()->with('status',__('admin_user.user_a_success'));
            //->with('status','Category added successfully');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_user_view(Request $request, $id = null){
        try {
            $data['user_id']    =   $id;
            $roles      = Role::pluck("name","id");   
            $user       = User::with('userDetails')->findorfail($id);
            $user_role  = $user->getRoleNames();
            $role_array = array();
            foreach ($user_role as $key => $value) {
                $role_array[] = $value;
            } 
            // $data['user_id']    =   $id;
            // $user = User::get_user_profile($data); 

            return View::make('Admin.User.viewuser')->with(compact(['user','roles','role_array']));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_user_edit(Request $request, $id = null){
        try {   
            $roles      = Role::pluck("name","id");   
            $user       = User::with('userDetails')->findorfail($id);
            $user_role  = $user->getRoleNames();
            $role_array = array();
            foreach ($user_role as $key => $value) {
                $role_array[] = $value;
            }
             return View::make('Admin.User.adduser')->with(compact(['user','roles','role_array']));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    public static function admin_user_update(Request $request){
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
            $data = $request->all();
            $user = User::findorfail($request->id);

            if (!empty($request['profile_pic'])) {
                $data['profile_pic'] = CommonController::image_uploader(Input::file('profile_pic'));
                if (empty($request['profile_pic']))
                    return Redirect::back()->witherrors(__('admin_dashboard.image_u_error'));
            } else
                $data['profile_pic'] = $user->profile_pic;
            $data['user_id']    = $user->id;
            User::update_user_admin($data,$user);
            
           // $user->removeRole($user->role);             
            //$user->assignRole($request->role); 
            // All current roles will be removed from the user and replaced by the array given
           $user->syncRoles([$request->role]);

            $user_details       = UserDetail::where('user_id',$data['user_id'])->first();
            UserDetail::update_user_admin($data,$user_details);     
            return Redirect::back()->with('status', __('admin_user.user_u_success'));
            //return Redirect::route('admin_user_edit', ['id' => $request->id])->with('status', 'User updated successfully');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    /****************All Business users related functions given below**************************/
    
    //////////////// 		All Business Uesrs     /////////// ///// 
    public static function admin_b_user_all(Request $request) { 
        try { 
            $users = Admin::paginate(10);//where('status', 'active')->
            return View::make('Admin.Buser.allbusers')->with(compact('users'));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
      public static function admin_b_user_add_get(){
         try { 
           // $roles = Role::pluck("name","id"); 
            return View::make('Admin.Buser.addbuser');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    public static function admin_b_user_add_post(Request $request){
        try {
            $rules = array( 
                'name'          =>  'required|max:150',                
                'email'         =>  'required|unique:admin,email|max:150',
                //'phone'         =>  'unique:users',
                'password'      =>  'required|min:6|max:50',
                'profile_pic'   =>  'image' 
            );
            $msg=array(
                'profile_pic.image'     =>      __('admin_dashboard.profile_img') 
            );
            $validator = Validator::make($request->all(), $rules,$msg);
            if ($validator->fails())
                return Redirect::back()->witherrors($validator->getMessageBag()->first())->withInput();
            $data = $request->all();
            if (!empty($request->profile_pic)) {
                $filename = CommonController::image_uploader(Input::file('profile_pic'));

                if (empty($filename))
                    return Redirect::back()->witherrors(__('admin_dashboard.image_u_error'));

                $data['profile_pic'] = $filename;
            }
            $request['user_id'] = Admin::create_new_admin($data); 
            return Redirect::back()->with('status',__('admin_user.user_a_success'));

        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_b_user_view(Request $request, $id = null){
        try { 
            $user               =   Admin::findorfail($id);
            return View::make('Admin.Buser.viewbuser')->with(compact(['user']));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    
    public static function admin_b_user_edit(Request $request, $id = null){
        try {
            $user = Admin::findorfail($id);
             return View::make('Admin.Buser.addbuser')->with(compact(['user']));
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
    public static function admin_b_user_update(Request $request){
         try { 
            $rules = array( 
                'name'          =>  'required|max:150',   
                'email'         =>  'bail|nullable|unique:users,email,' . $request->id . ',id',
                //'phone'         =>  'bail|nullable|numeric|unique:users,phone,' . $request->id . ',id', 
                //'phone'       =>  'unique:users',
                'password'      =>  'nullable|min:6|max:50',
                'profile_pic'   =>  'image'
            );
            $msg=array(
                 'profile_pic.image'     =>      __('admin_dashboard.profile_img') 
            );
            $validator = Validator::make($request->all(), $rules,$msg);
            if ($validator->fails())
                return Redirect::back()->witherrors($validator->getMessageBag()->first())->withInput();
            $data = $request->all();
            $user = Admin::findorfail($request->id);

            if (!empty($request['profile_pic'])) {
                $data['profile_pic'] = CommonController::image_uploader(Input::file('profile_pic'));
                if (empty($request['profile_pic']))
                    return Redirect::back()->witherrors(__('admin_dashboard.image_u_error'));
            } else
                $data['profile_pic'] = $user->profile_pic;
            $request['id'] = Admin::admin_update($data,$user);
            return Redirect::back()->with('status', __('admin_user.user_u_success'));
            //return Redirect::route('admin_user_edit', ['id' => $request->id])->with('status', 'User updated successfully');
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }

     public static function admin_b_user_block(Request $request, $id = null, $status = null) {
        try {
            $user = Admin::findorfail($id);

            if ($status == 1) {

                if ($user->status == 'block')
                    return Redirect::back()->withErrors(__('admin_user.user_a_block'))->withInput();

                DB::Table('admin')->where('id', $user->id)->update(array(
                    'status' => 'block',
                    'updated_at' => new \DateTime
                ));

                return Redirect::back()->with('status', __('admin_user.user_block'));
            }
            else {
                if ($user->status == 'active')
                    return Redirect::back()->withErrors(__('admin_user.user_a_unblock'))->withInput();

                DB::Table('admin')->where('id', $user->id)->update(array(
                    'status' => 'active',
                    'updated_at' => new \DateTime
                ));

                return Redirect::back()->with('status', __('admin_user.user_unblock'));
            }
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }
}
