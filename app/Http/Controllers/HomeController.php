<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users=User::find(Auth::user()->id);
        if(@$users->landlord==0 && @$users->brandOwner==1){
          return view('home');
        }
        elseif(@$users->landlord==1 && @$users->brandOwner==0){
          return view('home');
       }
       elseif(@$users->landlord==1 && @$users->brandOwner==1){
         return view('home');
       }
       elseif(@$users->landlord==0 && @$users->brandOwner==0){
         return view('home');
       }
     }
}
