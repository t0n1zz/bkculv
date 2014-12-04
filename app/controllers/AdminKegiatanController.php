<?php

class AdminKegiatanController extends \BaseController{

    public function index()
    {
        $kegiatans = Kegiatan::with('Admin')->get();
        return View::make('admins.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return View::make('admins.kegiatan.create');
    }


    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Kegiatan::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $kegiatan = new kegiatan();
            $name = Input::get('name');

            $this->input_data($kegiatan,$name);

            if($kegiatan->save()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.kegiatan.create')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.kegiatan.index')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            }
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kegiatan.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.kegiatan.index');
        }
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);

        return View::make('admins.kegiatan.edit', compact('kegiatan'));
    }

    public function update($id)
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            //validasi
            $validator = Validator::make($data = Input::all(), Kegiatan::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kegiatan = Kegiatan::findOrFail($id);
            $this->input_data($kegiatan,$name);

            //simpan
            if($kegiatan->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.kegiatan.create')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.kegiatan.index')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            }
            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan informasi kegiatan.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.kegiatan.index');
        }
    }

    public function input_data($kegiatan,$name){
        $kegiatan->name = $name;
        $kegiatan->penulis = Input::get('penulis');

        $timestamp = strtotime(Input::get('tanggal'));
        $tanggal = date('Y-m-d',$timestamp);
        $kegiatan->tanggal = $tanggal;

        $timestamp2 = strtotime(Input::get('tanggal2'));
        $tanggal2 = date('Y-m-d',$timestamp2);
        $kegiatan->tanggal2 = $tanggal2;

        $kegiatan->wilayah = Input::get('wilayah');
        $kegiatan->tempat = Input::get('tempat');
        $kegiatan->sasaran = Input::get('sasaran');
        $kegiatan->fasilitator = Input::get('fasilitator');
    }

    public function destroy()
    {
        $id = Input::get('id');

        if(Kegiatan::destroy($id))
            return Redirect::route('admins.kegiatan.index')->with('message', 'Informasi kegiatan telah berhasil di hapus.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kegiatan.');
    }
}