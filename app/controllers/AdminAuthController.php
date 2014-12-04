<?php

class AdminAuthController extends \BaseController{

    public function getLogin(){
        return View::make('admins.auth.login')->with('message','Maaf, anda harus login terlebih dahulu.');
    }

    public function postLogin(){
        $data = Input::all();

        $validator = Validator::make($data, Admin::$rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){
            if(Auth::check()) { $id = Auth::user()->getId();}

            $admin = Admin::find($id);
            $admin->login = Date::now();

            if($admin->update())
                return Redirect::intended('admins');

            return Redirect::route('admins.login')->with('errormessage','Terjadi kesalahan.');
        }

        return Redirect::route('admins.login')->with('errormessage','Username atau password anda salah.');
    }

    public function getLogout(){
        if(Auth::check()) { $id = Auth::user()->getId();}

        $admin = Admin::find($id);
        $admin->logout = Date::now();

        if($admin->update()){
            Auth::logout();
            return Redirect::route('admins.login')->with('message','Anda telah berhasil logout.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah admin.');
    }

    public function getBack(){
        Auth::logout();
        return Redirect::route('home');
    }
}