<?php

class AdminStaffCuprimerController extends \BaseController {

    public function index()
    {
        $staffs = Staff_cuprimer::with('Cuprimer')->get();

        return View::make('admins.staff_cuprimer.index', compact('staffs'));
    }

    public function create()
    {
        $cuprimers = Cuprimer::all();
        return View::make('admins.staff_cuprimer.create',compact('cuprimers'));
    }

    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Staff_cuprimer::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $staff = new Staff_cuprimer();
            $data2 = $this->input_data($staff,$data);

            if(Staff_cuprimer::create($data2)){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.staff_cuprimer.create')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.staff_cuprimer.index')->with('message', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah staff.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.staff_cuprimer.index');
        }
    }

    public function edit($id)
    {
        $staff = Staff_cuprimer::find($id);

        return View::make('admins.staff_cuprimer.edit', compact('staff'));
    }

    public function update($id)
    {
        $staff = Staff_cuprimer::findOrFail($id);

        if(Input::get('simpan') || Input::get('simpan2')){
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), Staff::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $data2 = $this->input_data($staff,$data);

            //simpan
            if($staff->update($data2)) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.staff_cuprimer.create')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.staff_cuprimer.index')->with('message', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah staff.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.staff_cuprimer.index');
        }
    }


    public function input_data($staff,$data){
        //get php max file upload size
        $file_max = ini_get('upload_max_filesize');
        $file_max_str_leng = strlen($file_max);
        $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
        $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
        $file_max = substr($file_max,0,$file_max_str_leng - 1);
        $file_max = intval($file_max);

        //gambar
        try {
            $img = Input::file('gambar');
            if (!empty($img)) {
                $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $staff, $filename))
                    array_set($data,'gambar',$filename);
                else
                    return Redirect::back()->withInput()->with('errormessage', 'Terjadi kesalahan dalam penyimpanan gambar.');
            }
        } catch (Exception $e) {
            return Redirect::back()->withInput()->with('errormessage', 'Ukuran gambar harus lebih kecil dari ' . $file_max . " " . $file_max_meassure_unit);
        }

        return $data;
    }

    public function destroy()
    {
        $id = Input::get('id');
        $staff = Staff_cuprimer::findOrFail($id);
        $path = public_path('images_cu/');

        File::delete($path . $staff->gambar);
        Staff_cuprimer::destroy($id);

        return Redirect::route('admins.staff_cuprimer.index')->with('message', 'Staff Telah berhasil di hapus.');;
    }


    function save_image($img,$staff,$filename){

        $path = public_path('images_cu/');
        File::delete($path . $staff->gambar);

        if(Image::make($img->getRealPath())->resize(360, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path . $filename))
            return true;
        else
            return false;
    }
}