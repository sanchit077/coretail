<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function index(){
  return view('User.Other.sign-in');
}

public function passwordlink(){
  return view('User.Other.password-link-send');
}
}
