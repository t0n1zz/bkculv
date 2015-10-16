<?php

class AdminStaffController extends \BaseController{

    protected $status ="";

    public function index()
    {
        $staffs = Staff::with('cuprimer')->orderBy('cu','asc')->get();;
        $cuprimers = Cuprimer::all();

        return View::make('admins.staff.index', compact('staffs','cuprimers'));
    }

    public function create()
    {
        $cuprimers = Cuprimer::orderBy('name','asc')->get();;
        return View::make('admins.staff.create',compact('cuprimers'));
    }

    public function store()
    {
        $validator = Validator::make($data = Input::all(), Staff::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        $staff = new Staff();
        $data2 = $this->input_data($staff,$data,$name);
        if($this->status !="")
            return Redirect::back()->withInput()->with('errormessage',$this->status);

        try{
            Staff::create($data2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

        if(Input::Get('simpan2'))
            return Redirect::route('admins.staff.create')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        else
            return Redirect::route('admins.staff.index')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
    }

    public function edit($id)
    {
        $staff = Staff::find($id);
        $cuprimers = Cuprimer::orderBy('name','asc')->get();;
        return View::make('admins.staff.edit', compact('staff','cuprimers'));
    }

    public function update($id)
    {
        $staff = Staff::findOrFail($id);

        //dd(Input::all());

        //validasi
        $validator = Validator::make($data = Input::all(), Staff::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $data2 = $this->input_data($staff,$data,$name);

        if($this->status != "")
            return Redirect::back()->withInput()->with('errormessage',$this->status);

        try{
            $staff->update($data2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

        //simpan
        if (Input::Get('simpan2'))
            return Redirect::route('admins.staff.create')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        else
            return Redirect::route('admins.staff.index')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
    }

    public function update_jabatan(){
        $id = Input::get('id');
        $staff = Staff::findOrFail($id);
        $staff->jabatan = Input::get('jabatan');
        $name = $staff->name;


        //simpan
        if($staff->update())
            return Redirect::route('admins.staff.index')->with('message', 'Jabatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan jabatan.');
    }

    public function update_tingkat(){
        $id = Input::get('id');
        $staff = Staff::findOrFail($id);
        $staff->tingkat = Input::get('tingkat');
        $name = $staff->name;

        //simpan
        if($staff->update())
            return Redirect::route('admins.staff.index')->with('message', 'Tingkatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan tingkatan.');
    }

    public function update_cu(){
        $id = Input::get('id');
        $staff = Staff::findOrFail($id);
        $staff->cu = Input::get('cu');
        $name = $staff->name;

        //simpan
        if($staff->update())
            return Redirect::route('admins.staff.index')->with('message', 'CU <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan cu.');
    }

    public function input_data($staff,$data,$nama){

        //gambar
        try {
            $img = Input::file('gambar');
            if (!is_null($img)) {
                $filename = preg_replace('/\s+/', '', $nama) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $staff, $filename))
                    array_set($data,'gambar',$filename);
                else
                    return false;
            }else{
                $filename = $staff->gambar;
                array_set($data,'gambar',$filename);
            }
        } catch (Exception $e) {
            $this->status = $e->getMessage();
        }

        return $data;
    }

    public function destroy()
    {
        $id = Input::get('id');
        $staff = Staff::findOrFail($id);
        $path = public_path('images_staff/');

        try{
            File::delete($path . $staff->gambar);
            Staff::destroy($id);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

        return Redirect::route('admins.staff.index')->with('message', 'Staff Telah berhasil di hapus.');;
    }


    function save_image($img,$staff,$filename){

        $path = public_path('images_staff/');
        File::delete($path . $staff->gambar);

        if(Image::make($img->getRealPath())->resize(360, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path . $filename))
            return true;
        else
            return false;
    }
}