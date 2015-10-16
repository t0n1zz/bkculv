<?php

class AdminCuprimerController extends \BaseController{

    public function index()
    {
        $cuprimers = Cuprimer::with('WilayahCuprimer')
            ->orderBy('name','asc')
            ->get();

        $wilayahcuprimers = WilayahCuprimer::all();
        $is_wilayah = false;

        return View::make('admins.cuprimer.index', compact('cuprimers','wilayahcuprimers','is_wilayah'));
    }

    public function index_wilayah($id){

        $cuprimers = Cuprimer::with('WilayahCuprimer')
            ->where('wilayah','=', $id)
            ->orderBy('name','asc')
            ->get();

        $wilayahcuprimers = WilayahCuprimer::all();
        $is_wilayah = true;
        //dd($artikels);
        return View::make('admins.cuprimer.index', compact('cuprimers','wilayahcuprimers','is_wilayah'));
    }

    public function create()
    {
        $wilayahcuprimers = WilayahCuprimer::orderBy('name','asc')->get();
        return View::make('admins.cuprimer.create',compact('wilayahcuprimers'));
    }


    public function store()
    {
        $validator = Validator::make($data = Input::all(), Cuprimer::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $cuprimer = new Cuprimer();
        $name = Input::get('name');

        $data2 = $this->input_data($cuprimer,$data);

        if(Cuprimer::create($data2)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.cuprimer.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.cuprimer.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan CU.');
    }

    public function edit($id)
    {
        $cuprimer = Cuprimer::find($id);
        $wilayahcuprimers = WilayahCuprimer::orderBy('name','asc')->get();

        return View::make('admins.cuprimer.edit', compact('cuprimer','wilayahcuprimers'));
    }

    public function update($id)
    {
        //get php max file upload size
        $file_max = ini_get('upload_max_filesize');
        $file_max_str_leng = strlen($file_max);
        $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
        $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
        $file_max = substr($file_max,0,$file_max_str_leng - 1);
        $file_max = intval($file_max);

        //validasi
        $validator = Validator::make($data = Input::all(), Cuprimer::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $cuprimer = Cuprimer::findOrFail($id);
        $data2 = $this->input_data($cuprimer,$data);
        if($data2 == false)
            return Redirect::back()->withInput()->with('errormessage','Ukuran file gambar harus lebih kecil dari '
                . $file_max . " " . $file_max_meassure_unit);

        //simpan
        if($cuprimer->update($data2)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.cuprimer.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.cuprimer.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan informasi CU.');
    }

    public function update_wilayah(){
        $id = Input::get('id');
        $cuprimer = Cuprimer::findOrFail($id);
        $name = $cuprimer->name;

        $oldwilayah = $cuprimer->wilayah;
        if($oldwilayahcuprimer = WilayahCuprimer::find($oldwilayah)){
            $oldwilayahcuprimer->jumlah -= 1;
            $oldwilayahcuprimer->update();
        }

        $newwilayah = Input::get('wilayah');
        if($newwilayah == 0){ $newwilayah = 1; }
        if($newwilayahcuprimer = WilayahCuprimer::find($newwilayah)){
            $newwilayahcuprimer->jumlah +=1;
            $newwilayahcuprimer->update();
        }

        $cuprimer->wilayah = $newwilayah;

        //simpan
        if($cuprimer->update())
            return Redirect::route('admins.cuprimer.index')->with('message', 'Wilayah CU <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan wilayah cu.');
    }

    public function update_berdiri(){
        $id = Input::get('id');
        $cuprimer = Cuprimer::findOrFail($id);

        $timestamp = strtotime(Input::get('ultah'));
        $tanggal = date('Y-m-d',$timestamp);
        $cuprimer->ultah = $tanggal;

        $name = $cuprimer->name;

        //simpan
        if($cuprimer->update())
            return Redirect::route('admins.cuprimer.index')->with('message', 'Tanggal berdiri CU <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan tanggal berdiri CU.');
    }

    public function update_bergabung(){
        $id = Input::get('id');
        $cuprimer = Cuprimer::findOrFail($id);

        $timestamp = strtotime(Input::get('bergabung'));
        $tanggal = date('Y-m-d',$timestamp);
        $cuprimer->bergabung = $tanggal;

        $name = $cuprimer->name;

        //simpan
        if($cuprimer->update())
            return Redirect::route('admins.cuprimer.index')->with('message', 'Tanggal bergabung CU <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan tanggal bergabung CU.');
    }

    public function input_data($cuprimer,$data){

        $timestamp = strtotime(Input::get('ultah'));
        $tanggal = date('Y-m-d',$timestamp);
        array_set($data,'ultah',$tanggal);

        $timestamp2 = strtotime(Input::get('bergabung'));
        $tanggal2 = date('Y-m-d',$timestamp2);
        array_set($data,'bergabung',$tanggal2);

        //kategori
        $wilayah = Input::get('wilayah');
        if($wilayah == "tambah"){
            $wilayahcuprimer = new WilayahCuprimer();
            $wilayahcuprimer->name = Input::get('wilayah_baru');
            if($wilayahcuprimer->save()){
                $last_id = $wilayahcuprimer->id;

                $oldwilayah = $cuprimer->kategori;
                if($oldwilayahcuprimer = WilayahCuprimer::find($oldwilayah)){
                    $oldwilayahcuprimer->jumlah -= 1;
                    $oldwilayahcuprimer->update();
                }

                array_set($data,'wilayah',$last_id);

                $newwilayah = $last_id;
                if($newwilayah == 0){ $newwilayah = 1; }
                if($newwilayahcuprimer = WilayahCuprimer::find($newwilayah)){
                    $newwilayahcuprimer->jumlah +=1;
                    $newwilayahcuprimer->update();
                }
            }
        }else {
            $oldwilayah = $cuprimer->wilayah;
            if ($oldwilayahcuprimer = WilayahCuprimer::find($oldwilayah)) {
                $oldwilayahcuprimer->jumlah -= 1;
                $oldwilayahcuprimer->update();
            }

            $newwilayah = $wilayah;
            if ($newwilayah == 0) {
                $newwilayah = 1;
            }
            if ($newwilayahcuprimer = WilayahCuprimer::find($newwilayah)) {
                $newwilayahcuprimer->jumlah += 1;
                $newwilayahcuprimer->update();
            }

            array_set($data,'wilayah',$wilayah);
        }

        //gambar
        try {
            $img = Input::file('gambar');
            if (!is_null($img)) {
                $filename = $cuprimer->name . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img, $cuprimer, $filename))
                    array_set($data,'gambar',$filename);
                else
                    return false;
            }else{
                $filename = $cuprimer->gambar;
                array_set($data,'gambar',$filename);
            }
        } catch (Exception $e) {
            return false;
        }

        //logo
        try {
            $img2 = Input::file('logo');
            if (!is_null($img2)) {
                $filename = $cuprimer->name ."-logo" . "-" . date('Y-m-d') . ".jpg";

                if ($this->save_image($img2, $cuprimer, $filename))
                    array_set($data,'logo',$filename);
                else
                    return false;
            }else{
                $filename = $cuprimer->logo;
                array_set($data,'logo',$filename);
            }
        } catch (Exception $e) {
            return false;
        }

        return $data;
    }

    public function destroy()
    {
        $id = Input::get('id');

        $cuprimer = Cuprimer::findOrFail($id);

        $oldwilayah = $cuprimer->wilayah;
        if($oldwilayahcuprimer = WilayahCuprimer::find($oldwilayah)){
            $oldwilayahcuprimer->jumlah -= 1;
            $oldwilayahcuprimer->update();
        }

        if(Cuprimer::destroy($id))
            return Redirect::route('admins.cuprimer.index')->with('message', 'Informasi kegiatan telah berhasil di hapus.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kegiatan.');
    }


    function save_image($img,$cuprimer,$filename){

        $path = public_path('images_cu/');
        File::delete($path . $cuprimer->gambar);

        if(Image::make($img->getRealPath())->resize(360, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path . $filename))
            return true;
        else
            return false;
    }
}