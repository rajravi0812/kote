<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function index()
    {
        return view('admin.login');
    }  


    public function sign_in(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {      
            $user = Auth::user(); 
            $name = $user->username; 
            $role = $user->role_id;
            // $user_id = Session::getId();

            Session::put('user', $name);
            // Session::put('user_id', $user_id);
            Session::put('role',$role);
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
      
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user(); 
            $username = Session::get('user');
            $role =  Session::get('role');
            $previous_route = "";
            
            return view('admin.dashboard.dashboard',compact('username','role','previous_route'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function user_register(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'role'   => 'required',
            'place' => 'required',
        ]);
            //   dd($request->input('name'));
        $user = new User();
        $user->username = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id =$request->input('role');
        $user->place = $request->input('place');
        $user->save();

        return redirect()->back()->with('success', 'Data Added Successfully');
     
    }


    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function loginold(){
        return view('admin.loginold');
    }
    
    
}