<?php

class AdminAdminController extends \BaseController{

    public function index()
    {
        $admins = Admin::all();

        return View::make('admins.admin.index', compact('admins'));
    }

    public function create()
    {
        return View::make('admins.admin.create');
    }

    public function store()
    {
        $validator = Validator::make($data = Input::all(), Admin::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');
        $username = Input::get('username');

        $admin = new Admin();

        $admin->name = $name;
        $admin->username = $username;
        $password1 = Input::get('password');
        $password2 = Input::get('password2');

        $checkusername = Admin::where('username','=',$username)->first();

        if(!empty($checkusername))
            return Redirect::back()->withInput()->with('errormessage','<b>Username</b> tidak tersedia, silahkan coba <b>Username</b> lain.');

        if($password1 != $password2)
            return Redirect::back()->withInput()->with('errormessage','<b>Password</b> dengan <b>Konfirmasi Password</b> tidak sama.');

        $admin->password = Hash::make($password1);

        if($admin->save()){
            $role = new Role();
            $role->name = $username;
            $role->save();

            $admin2 = Admin::where('username','=',$username)->first();
            $admin2->attachRole( $role );
            $admin2->roles()->attach( $role->id );

            $adminrole = Role::where('name','=',$username)->first();
            $this->hak_akses($adminrole,$admin2);

            return Redirect::route('admins.admin.index')->with('message', 'Admin <b><i>' .$name. '</i></b> telah berhasil ditambah.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah admin.');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return View::make('admins.admin.edit', compact('admin'));
    }

    public function update($id)
    {
        $admin = Admin::findOrFail($id);
        //dd(Input::all());

        //validasi
        $validator = Validator::make($data = Input::all(), Admin::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');

        $admin->name = $name;
        $admin->username = Input::get('username');

        $oldpassword = $admin->password;
        $oldpassword2 = Input::get('oldpassword');
        if (Hash::check($oldpassword2, $oldpassword)) {
            $admin->password = Hash::make(Input::get('password'));
        } else {
            return Redirect::back()->withInput()->with('errormessage', 'Password lama anda tidak sesuai.');
        }

        //simpan
        if($admin->update())
            return Redirect::route('admins.admin.index')->with('message', 'Admin <b><i>' . $name . '</i></b> telah berhasil diubah.');


        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah admin.');
    }

    public function destroy()
    {
        $id = Input::get('id');
        $admin = Admin::where('id','=',$id)->first();
        $name = $admin->name;
        $roles = Role::where('name','=',$admin->username)->first();

        if(!is_null($roles)){
            $roles->perms()->detach();
            Role::destroy($roles->id);
        }

        Admin::destroy($id);

        return Redirect::route('admins.admin.index')->with('message', 'Admin <b><i>' . $name . '</i></b> telah berhasil di hapus.');
    }

    public function update_status(){
        $id = Input::get('id');
        $status = Input::get('status');
        $admin = Admin::findOrFail($id);
        $name = $admin->name;
        $admin->status = $status;

        if($status == 0)
            $statusname = "non-aktifkan";
        else
            $statusname = "diaktifkan";

        if($admin->update())
            return Redirect::route('admins.admin.index')->with('message', 'Status admin <b><i>' . $name . '</i></b> telah <b>' . $statusname . '</b>.');


        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah status admin.');
    }

    public function edit_hak_akses($id)
    {
        $admin = Admin::find($id);

        return View::make('admins.admin.edit_hak_akses', compact('admin'));
    }

    public function update_hak_akses(){
        if(Input::get('simpan')) {
            $id = Input::get('id');
            $admin = Admin::where('id', '=', $id)->first();
            $name = $admin->name;
            $adminrole = Role::where('name', '=', $admin->username)->first();
            $this->hak_akses($adminrole, $admin);

            return Redirect::route('admins.admin.index')->with('message', 'Hak akses <b><i>' . $name . '</i></b> telah berhasil diubah.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.admin.index');
        }
    }

    public function hak_akses($adminrole,$admin2){
        if(Input::get('admin') == 1) {
            if (!$admin2->can('admin')){
                $akses = Permission::where('name', '=', 'admin')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('admin')){
                $akses = Permission::where('name','=','admin')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('artikel') == 1){
            if (!$admin2->can('artikel')){
                $akses = Permission::where('name', '=', 'artikel')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('artikel')){
                $akses = Permission::where('name','=','artikel')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('cuprimer') == 1){
            if (!$admin2->can('cuprimer')){
                $akses = Permission::where('name', '=', 'cuprimer')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('cuprimer')){
                $akses = Permission::where('name','=','cuprimer')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('gambarkegiatan') == 1){
            if (!$admin2->can('gambarkegiatan')){
                $akses = Permission::where('name', '=', 'gambarkegiatan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('gambarkegiatan')){
                $akses = Permission::where('name','=','gambarkegiatan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('infogerakan') == 1){
            if (!$admin2->can('infogerakan')){
                $akses = Permission::where('name', '=', 'infogerakan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('infogerakan')){
                $akses = Permission::where('name','=','infogerakan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('kantorpelayanan') == 1){
            if (!$admin2->can('kantorpelayanan')){
                $akses = Permission::where('name', '=', 'kantorpelayanan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('kantorpelayanan')){
                $akses = Permission::where('name','=','kantorpelayanan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('kategoriartikel') == 1){
            if (!$admin2->can('kategoriartikel')){
                $akses = Permission::where('name', '=', 'kategoriartikel')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('kategoriartikel')){
                $akses = Permission::where('name','=','kategoriartikel')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('kegiatan') == 1){
            if (!$admin2->can('kegiatan')){
                $akses = Permission::where('name', '=', 'kegiatan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('kegiatan')){
                $akses = Permission::where('name','=','kegiatan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('pelayanan') == 1){
            if (!$admin2->can('pelayanan')){
                $akses = Permission::where('name', '=', 'pelayanan')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('pelayanan')){
                $akses = Permission::where('name','=','pelayanan')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('pengumuman') == 1){
            if (!$admin2->can('pengumuman')){
                $akses = Permission::where('name', '=', 'pengumuman')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('pengumuman')){
                $akses = Permission::where('name','=','pengumuman')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('staff') == 1){
            if (!$admin2->can('staff')){
                $akses = Permission::where('name', '=', 'staff')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('staff')){
                $akses = Permission::where('name','=','staff')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('wilayahcuprimer') == 1){
            if (!$admin2->can('wilayahcuprimer')){
                $akses = Permission::where('name', '=', 'wilayahcuprimer')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('wilayahcuprimer')){
                $akses = Permission::where('name','=','wilayahcuprimer')->first();
                $adminrole->detachPermission($akses);
            }
        }

        if(Input::get('download') == 1){
            if (!$admin2->can('download')){
                $akses = Permission::where('name', '=', 'download')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('download')){
                $akses = Permission::where('name','=','download')->first();
                $adminrole->detachPermission($akses);
            }
        }
    }

}