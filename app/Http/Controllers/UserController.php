<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    
//registerページに関する記述

    public function register(){

        return view('register');
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('user.login')->with('success', 'Registerd successfully!');
    }



//loginページに関する記述

    public function login(){

        return view('login');
    }


    public function authenticate(Request $request){

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->route('user.login')->withInput()->withErrors($validator);
        }

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            if(Auth::user()->role == 'user'){

                return redirect()->route('user.home');

            }elseif(Auth::user()->role == 'admin'){
                
                return redirect()->route('admin.admin_page');
            }
            
        }else{

            return redirect()->route('user.login')->with('error', 'Email or password incorrect!');
        }
    }


//homeページに関する記述

    public function home(){

        return view('home');
    }

}
