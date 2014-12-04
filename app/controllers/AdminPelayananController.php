<?php

class AdminPelayananController extends \BaseController{

    public function index()
    {
        $pelayanans = Pelayanan::all();

        return View::make('admins.pelayanan.index', compact('pelayanans'));
    }

    public function create()
    {
        $pelayanan = Pelayanan::all();

        return View::make('admins.pelayanan.create', compact('pelayanan'));
    }

    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Pelayanan::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $pelayanan = new Pelayanan();
            $this->input_data($pelayanan,$name);

            if($pelayanan->save()){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.pelayanan.create')->with('message', 'Pelayanan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.pelayanan.index')->with('message', 'Pelayanan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah pelayanan.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.pelayanan.index');
        }
    }

    public function edit($id)
    {
        $pelayanan = Pelayanan::find($id);

        return View::make('admins.pelayanan.edit', compact('pelayanan'));
    }

    public function update($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

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
            $validator = Validator::make($data = Input::all(), Pelayanan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');

            $this->input_data($pelayanan,$name);

            //simpan
            if($pelayanan->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.pelayanan.create')->with('message', 'Pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.pelayanan.index')->with('message', 'Pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah pelayanan.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.pelayanan.index');
        }
    }

    public function input_data($pelayanan,$name){
        $pelayanan->name = $name;
        $pelayanan->content = Input::get('content');

        //gambar
        try {
            $img = Input::file('gambar');
            if (!empty($img)) {
                $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $pelayanan, $filename))
                    $pelayanan->gambar = $filename;
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