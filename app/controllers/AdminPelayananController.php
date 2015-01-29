<?php

class AdminPelayananController extends \BaseController{

    public function index()
    {
        $pelayanans = Pelayanan::orderBy('name','asc')->get();;

        return View::make('admins.pelayanan.index', compact('pelayanans'));
    }

    public function create()
    {
        return View::make('admins.pelayanan.create');
    }

    public function store()
    {
        $validator = Validator::make($data = Input::all(), Pelayanan::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        $pelayanan = new Pelayanan();
        $data2 = $this->input_data($pelayanan,$data);

        if(Pelayanan::create($data2)){
            if(Input::Get('simpan2'))
                return Redirect::route('admins.pelayanan.create')->with('message', 'Pelayanan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.pelayanan.index')->with('message', 'Pelayanan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah pelayanan.');
    }

    public function edit($id)
    {
        $pelayanan = Pelayanan::find($id);

        return View::make('admins.pelayanan.edit', compact('pelayanan'));
    }

    public function update($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        //dd(Input::all());

        //validasi
        $validator = Validator::make($data = Input::all(), Pelayanan::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $data2 = $this->input_data($pelayanan,$data);

        //simpan
        if($pelayanan->update($data2)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.pelayanan.create')->with('message', 'Pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.pelayanan.index')->with('message', 'Pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah pelayanan.');
    }

    public function input_data($pelayanan,$data){
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
            if (!is_null($img)) {
                $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $pelayanan, $filename))
                    array_set($data,'gambar',$filename);
                else
                    return Redirect::back()->withInput()->with('errormessage', 'Terjadi kesalahan dalam penyimpanan gambar.');
            }else{
                $filename = $pelayanan->gambar;
                array_set($data,'gambar',$filename);
            }
        } catch (Exception $e) {
            return Redirect::back()->withInput()->with('errormessage', 'Ukuran gambar harus lebih kecil dari ' . $file_max . " " . $file_max_meassure_unit);
        }

        return $data;
    }

    public function destroy()
    {
        $id = Input::get('id');
        $pelayanan = Pelayanan::findOrFail($id);
        $path = public_path('images_artikel/');

        File::delete($path . $pelayanan->gambar);
        Pelayanan::destroy($id);

        return Redirect::route('admins.pelayanan.index')->with('message', 'Pelayanan Telah berhasil di hapus.');;
    }


    function save_image($img,$pelayanan,$filename){

        list($width, $height) = getimagesize($img);

        $path = public_path('images_artikel/');
        File::delete($path . $pelayanan->gambar);

        if($width > 400){
            if(Image::make($img->getRealPath())->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();})->save($path . $filename))
                return true;
            else
                return false;
        }else{
            if(Image::make($img->getRealPath())->save($path . $filename))
                return true;
            else
                return false;
        }
    }
}