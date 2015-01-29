<?php

class AdminKegiatanController extends \BaseController{

    public function index()
    {
        $kegiatans = kegiatan::with('Admin')->orderBy('name','asc')->get();;
        return View::make('admins.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return View::make('admins.kegiatan.create');
    }


    public function store()
    {
        $validator = Validator::make($data = Input::all(), Kegiatan::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $data2 = $this->input_data($data);

        if(kegiatan::create($data2)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.kegiatan.create')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.kegiatan.index')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kegiatan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);

        return View::make('admins.kegiatan.edit', compact('kegiatan'));
    }

    public function update($id)
    {
        //validasi
        $validator = Validator::make($data = Input::all(), Kegiatan::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $kegiatan = Kegiatan::findOrFail($id);
        $data2 = $this->input_data($data);


        //simpan
        if($kegiatan->update($data2)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.kegiatan.create')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.kegiatan.index')->with('message', 'Kegiatan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan informasi kegiatan.');
    }

    public function update_mulai(){
        $id = Input::get('id');
        $kegiatan = Kegiatan::findOrFail($id);

        $timestamp = strtotime(Input::get('tanggal'));
        $tanggal = date('Y-m-d',$timestamp);
        $kegiatan->tanggal = $tanggal;

        $name = $kegiatan->name;

        //simpan
        if($kegiatan->update())
            return Redirect::route('admins.kegiatan.index')->with('message', 'Tanggal mulai kegiatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan tanggal mulai kegiatan.');
    }

    public function update_selesai(){
        $id = Input::get('id');
        $kegiatan = Kegiatan::findOrFail($id);

        $timestamp = strtotime(Input::get('tanggal'));
        $tanggal = date('Y-m-d',$timestamp);
        $kegiatan->tanggal2 = $tanggal;

        $name = $kegiatan->name;

        //simpan
        if($kegiatan->update())
            return Redirect::route('admins.kegiatan.index')->with('message', 'Tanggal selesai kegiatan <b><i>' .$name. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan tanggal selesai kegiatan.');
    }

    public function input_data($data){

        $timestamp = strtotime(Input::get('tanggal'));
        $tanggal = date('Y-m-d',$timestamp);
        array_set($data,'tanggal',$tanggal);

        $timestamp2 = strtotime(Input::get('tanggal2'));
        $tanggal2 = date('Y-m-d',$timestamp2);
        array_set($data,'tanggal2',$tanggal2);

        return $data;
    }

    public function destroy()
    {
        $id = Input::get('id');

        if(Kegiatan::destroy($id))
            return Redirect::route('admins.kegiatan.index')->with('message', 'Informasi kegiatan telah berhasil di hapus.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kegiatan.');
    }
}