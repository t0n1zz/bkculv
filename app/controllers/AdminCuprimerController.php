<?php

class AdminCuprimerController extends \BaseController{

    public function index()
    {
        $cuprimers = Cuprimer::with('WilayahCuprimer')->get();
        $wilayahcuprimers = WilayahCuprimer::all();
        $is_wilayah = false;

        return View::make('admins.cuprimer.index', compact('cuprimers','wilayahcuprimers','is_wilayah'));
    }

    public function index_wilayah($id){

        $cuprimers = Cuprimer::with('WilayahCuprimer')->where('wilayah','=', $id)->get();
        $wilayahcuprimers = WilayahCuprimer::all();
        $is_wilayah = true;
        //dd($artikels);
        return View::make('admins.cuprimer.index', compact('cuprimers','wilayahcuprimers','is_wilayah'));
    }

    public function create()
    {
        $wilayahcuprimers = WilayahCuprimer::all();

        return View::make('admins.cuprimer.create',compact('wilayahcuprimers'));
    }


    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $cuprimer = new Cuprimer();
            $name = Input::get('name');

            $this->input_data($cuprimer,$name);

            if($cuprimer->save()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.cuprimer.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.cuprimer.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            }
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan CU.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.cuprimer.index');
        }
    }

    public function edit($id)
    {
        $cuprimer = Cuprimer::find($id);
        $wilayahcuprimers = WilayahCuprimer::all();

        return View::make('admins.cuprimer.edit', compact('cuprimer','wilayahcuprimers'));
    }

    public function update($id)
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            //validasi
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $cuprimer = Cuprimer::findOrFail($id);
            $this->input_data($cuprimer,$name);

            //simpan
            if($cuprimer->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.cuprimer.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.cuprimer.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan informasi CU.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.cuprimer.index');
        }
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

    public function input_data($cuprimer,$name){
        $cuprimer->name = $name;

        $timestamp = strtotime(Input::get('ultah'));
        $tanggal = date('Y-m-d',$timestamp);
        $cuprimer->ultah = $tanggal;

        $cuprimer->content = Input::get('content');

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

                $cuprimer->wilayah = $last_id;

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
            $cuprimer->wilayah = $wilayah;
        }
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
}