<?php

class AdminStaffController extends \BaseController{

    public function index()
    {
        $staffs = Staff::all();

        return View::make('admins.staff.index', compact('staffs'));
    }

    public function create()
    {
        $staff = Staff::all();

        return View::make('admins.staff.create', compact('staff'));
    }

    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Staff::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $staff = new Staff();
            $this->input_data($staff,$name);

            if($staff->save()){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.staff.create')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.staff.index')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah staff.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.staff.index');
        }
    }

    public function edit($id)
    {
        $staff = Staff::find($id);

        return View::make('admins.staff.edit', compact('staff'));
    }

    public function update($id)
    {
        $staff = Staff::findOrFail($id);

        //get php max file upload size
        $file_max = ini_get('upload_max_filesize');
        $file_max_str_leng = strlen($file_max);
        $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
        $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
        $file_max = substr($file_max,0,$file_max_str_leng - 1);
        $file_max = intval($file_max);

        if(Input::get('simpan') || Input::get('simpan2')){
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), Staff::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');

            $this->input_data($staff,$name);

            //simpan
            if($staff->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.staff.create')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.staff.index')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah staff.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.staff.index');
        }
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

    public function input_data($staff,$name){
        $staff->name = $name;
        $staff->jabatan = Input::get('jabatan');
        $staff->tingkat = Input::get('tingkat');

        //gambar
        try {
            $img = Input::file('gambar');
            if (!empty($img)) {
                $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $staff, $filename))
                    $staff->gambar = $filename;
                else
                    return Redirect::back()->withInput()->with('errormessage', 'Terjadi kesalahan dalam penyimpanan gambar.');
            }
        } catch (Exception $e) {
            return Redirect::back()->withInput()->with('errormessage', 'Ukuran gambar harus lebih kecil dari ' . $file_max . " " . $file_max_meassure_unit);
        }
    }

    public function destroy()
    {
        $id = Input::get('id');
        $staff = Staff::findOrFail($id);
        $path = public_path('images_staff/');

        File::delete($path . $staff->gambar);
        Staff::destroy($id);

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