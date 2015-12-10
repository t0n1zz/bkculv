<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{
    protected $indexpath = 'admins.artikel.index';
    protected $createpath = 'admins.artikel.create';
    protected $editpath = 'admins.artikel.edit';
    protected $imagepath = 'images_artikel/';
    protected $status ="";
    protected $isgambar = true;
    protected $message = 'User';

    public function index()
    {
        try{
            $datas = User::all();
            return View::make($this->indexpath, compact('datas'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            return View::make($this->createpath);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), User::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');
            $username = Input::get('username');

            $kelas = new User();

            //input
            $kelas->name = $name;
            $kelas->username = $username;
            $password1 = Input::get('password');
            $password2 = Input::get('password2');
            $tipe = Input::get('tipe');

            //check username
            $checkusername = Admin::where('username','=',$username)->first();
            if(!empty($checkusername))
                return Redirect::back()->withInput()->with('errormessage','<b>Username</b> tidak tersedia, silahkan coba <b>Username</b> lain.');

            //check password
            if($password1 != $password2)
                return Redirect::back()->withInput()->with('errormessage','<b>Password</b> dengan <b>Konfirmasi Password</b> tidak sama.');

            $kelas->password = Hash::make($password1);

            //check tipe
            if($tipe = 1){
                $role = role::where('id','=','1')->first();
                $kelas->cu = Input::get('cu');
            }else{
                $role = new Role();
                $role->name = $username;
                $role->save();
                $kelas->cu = 0;
            }
            $kelas->save();

            if($tipe = 1){
                $kelas2 = user::where('username','=',$username)->first();
                $kelas2->attachRole( $role );
                $kelas2->roles()->attach( $role->id );
            }else{
                $kelas2 = user::where('username','=',$username)->first();
                $kelas2->attachRole( $role );
                $kelas2->roles()->attach( $role->id );

                $role2 = Role::where('name','=',$username)->first();
                $this->hak_akses($role2,$kelas2);
            }

            if (Input::Get('simpan2'))
                return Redirect::route($this->createpath)->with('sucessmessage', 'User <b><i>' .$nama. '</i></b> telah berhasil ditambah.');
            else
                return Redirect::route($this->indexpath)->with('sucessmessage', 'User <b><i>' .$nama. '</i></b> telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        $datas = User::find($id);

        return View::make($this->editpath, compact('datas'));
    }

    public function update($id)
    {
        try{
            $kelas = User::findOrFail($id);
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), User::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kelas->name = $name;
            $kelas->username = Input::get('username');
            $password1 = Input::get('password');
            $password2 = Input::get('password2');

            if($password1 != $password2)
                return Redirect::back()->withInput()->with('errormessage','<b>Password</b> dengan <b>Konfirmasi Password</b> tidak sama.');

            $kelas->password = Hash::make($password1);
            $kelas->update();

            if (Input::Get('simpan2'))
                return Redirect::route($this->createpath)->with('sucessmessage', 'Password user telah berhasil diubah.');
            else
                return Redirect::route($this->indexpath)->with('sucessmessage', 'Password user telah berhasil diubah.');

        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status(){
        try{
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
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_tipe(){
        try{
            $id = Input::get('id');
            $tipe = input::get('tipe');
            $kelas = user::findOrFail($id);

            if($tipe == 1){
                $role = Role::where('id','=','2')->first();
                $kelas->cu = Input::get('cu');
            }else{
                $name = $kelas->name;
                $role = Role::where('name','=',$name)->first();
                $kelas->cu = 0;
            }

            $kelas2 = User::where('id','=',$id)->first();
            $kelas2->roles()->detach();
            $kelas2->attachRole($role);
            $kelas2->roles()->attach( $role->id );

            $kelas->update();

            return Redirect::route($this->indexpath)->with('sucessmessage', 'Tipe user telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_cu(){
        try{
            $id = Input::get('id');
            $cu = Input::get('cu');
            $kelas = User::findOrFail($id);
            $kelas->cu = $cu;

            $kelas->update();

            return Redirect::route($this->indexpath)->with('sucessmessage', 'CU user telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = User::where('id','=',$id)->first();
            $name = $kelas->name;
            $roles = Role::where('name','=',$kelas->username)->first();

            if(!is_null($roles)){
                $roles->perms()->detach();
                Role::destroy($roles->id);
            }

            User::destroy($id);

            return Redirect::route('admins.user.index')->with('sucessmessage', 'User <b><i>' . $name . '</i></b> telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function edit_hak_akses($id)
    {
        try{
            $admin = Admin::find($id);

            return View::make('admins.admin.edit_hak_akses', compact('admin'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_hak_akses(){
        try{
            if(Input::get('simpan')) {
                $id = Input::get('id');
                $kelas = User::where('id', '=', $id)->first();
                $name = $kelas->name;
                $role = Role::where('name', '=', $kelas->username)->first();

                $this->hak_akses($role, $kelas);

                return Redirect::route($this->indexpath)->with('sucessmessage', 'Hak akses <b><i>' . $name . '</i></b> telah berhasil diubah.');
            }elseif(Input::get('batal')){
                return Redirect::route($this->indexpath);
            }
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
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

        if(Input::get('saran') == 1){
            if (!$admin2->can('saran')){
                $akses = Permission::where('name', '=', 'saran')->first();
                $adminrole->attachPermission($akses);
            }
        }else{
            if($admin2->can('saran')){
                $akses = Permission::where('name','=','saran')->first();
                $adminrole->detachPermission($akses);
            }
        }
    }
}
