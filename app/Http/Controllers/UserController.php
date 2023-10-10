<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Session;
class UserController extends Controller
{
  public function signInPage(){
    $key = session('username');
    if($key){
      return redirect('/');
    }
    else{
      return redirect('sign_in');
    }
  }
  public function signUp(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'pass' => 'required',
    ]);
    $user = new User;
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->phone_number = $request->input('phone');
    $pass = $request->input('pass');
    $cpass = $request->input('cpass');
    if ($pass == $cpass) {
      $user->password = $pass;
    } else {
      return;
    }
    $user->save();
    return redirect('/')->with('username', $user->username);
  }

  public function login(Request $request)
  {
    $request->validate([
      'phone' => 'required',
      'pass' => 'required'
    ]);
    $phone = $request->input('phone');
    $user = User::where('phone_number',$phone)->select('username')->first();
    if ($user != null) {
      $checkPass = User::where('phone_number', $phone)->select('password', 'username','role')->first();
      $password = $checkPass->password;
      if ($password) {
        if ($password == $request->input('pass')) {
          if($checkPass->role == 1){
            return redirect('/')->with('username',$checkPass->username);
          }else{
            return redirect('/')->with('username',$checkPass->username);
          }
        } else {
         return back()->with('error','Wrong Password');
        }
      } else {
        return back()->with('error','Wrong Id and Password');
      }
    } else {
      return back()->with('error','User not registered');
    }
  }


}
