<?php

class AdminAdminController extends \BaseController{

    public function index()
    {
        $admins = Admin::all();

        return View::make('admins.admin.index', compact('admins'));
    }

    public function create()
    {
        $admin = Admin::all();

        return View::make('admins.admin.create', compact('admin'));
    }

    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Admin::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $admin = new Admin();
            $this->input_data($admin,$name,false);

            if($admin->save()){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.staff.create')->with('message', 'Admin <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.staff.index')->with('message', 'Admin <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah admin.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.admin.index');
        }
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return View::make('admins.admin.edit', compact('admin'));
    }

    public function update($id)
    {
        $admin = Admin::findOrFail($id);

        if(Input::get('simpan') || Input::get('simpan2')){
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), Admin::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');

            $this->input_data($admin,$name,true);

            //simpan
            if($admin->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.staff.create')->with('message', 'Admin <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.staff.index')->with('message', 'Admin <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah admin.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.admin.index');
        }
    }

    public function input_data($admin,$name,$update){
        $admin->name = $name;
        $admin->username = Input::get('username');

        if($update){
            $oldpassword = $admin->password;
            $oldpassword2 = Input::get('oldpassword');
            if (Hash::check($oldpassword2, $oldpassword)) {
                $admin->password = Hash::make(Input::get('password'));

            } else {
                return Redirect::back()->withInput()->with('errormessage', 'Password lama anda tidak sesuai.');
            }
        }else{
            $admin->password = Hash::make(Input::get('password'));
        }
    }

    public function destroy()
    {
        $id = Input::get('id');
        Staff::destroy($id);

        return Redirect::route('admins.admin.index')->with('message', 'Admin Telah berhasil di hapus.');;
    }
}