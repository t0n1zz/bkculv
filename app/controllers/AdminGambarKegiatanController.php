<?php

class AdminGambarKegiatanController extends \BaseController{

    public function index()
    {
        $gambarkegiatans = GambarKegiatan::paginate(12);

        return View::make('admins.gambarkegiatan.index', compact('gambarkegiatans'));
    }

    public function create()
    {
        return View::make('admins.gambarkegiatan.create');
    }

    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), GambarKegiatan::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $gambarkegiatan = new GambarKegiatan();
            $this->input_data($gambarkegiatan,$name);

            if($gambarkegiatan->save()){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.gambarkegiatan.create')->with('message', 'Gambar kegiatan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.gambarkegiatan.index')->with('message', 'Gambar kegiatan <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam menambah gambar kegiatan.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.gambarkegiatan.index');
        }
    }

    public function edit($id)
    {
        $gambarkegiatan = GambarKegiatan::find($id);

        return View::make('admins.gambarkegiatan.edit', compact('gambarkegiatan'));
    }

    public function update($id)
    {
        $gambarkegiatan = GambarKegiatan::findOrFail($id);

        if(Input::get('simpan') || Input::get('simpan2')){
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), GambarKegiatan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');

            $this->input_data($gambarkegiatan,$name);

            //simpan
            if($gambarkegiatan->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.gambarkegiatan.create')->with('message', 'Gambar kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.gambarkegiatan.index')->with('message', 'Gambar kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam mengubah gambar kegiatan.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.gambarkegiatan.index');
        }
    }

    public function input_data($gambarkegiatan,$name){
        //get php max file upload size
        $file_max = ini_get('upload_max_filesize');
        $file_max_str_leng = strlen($file_max);
        $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
        $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
        $file_max = substr($file_max,0,$file_max_str_leng - 1);
        $file_max = intval($file_max);

        $gambarkegiatan->name = $name;

        //gambar
        try {
            $img = Input::file('gambar');
            if (!empty($img)) {
                $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $gambarkegiatan, $filename))
                    $gambarkegiatan->gambar = $filename;
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
        $gambarkegiatan = GambarKegiatan::findOrFail($id);
        $path = public_path('images_kegiatan/');

        File::delete($path . $gambarkegiatan->gambar);
        GambarKegiatan::destroy($id);

        return Redirect::route('admins.gambarkegiatan.index')->with('message', 'Gambar kegiatan telah berhasil di hapus.');;
    }


    function save_image($img,$pelayanan,$filename){

        list($width, $height) = getimagesize($img);

        $path = public_path('images_kegiatan/');
        File::delete($path . $pelayanan->gambar);

        if($width > 1280){
            if(Image::make($img->getRealPath())->resize(1280, null, function ($constraint) {
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