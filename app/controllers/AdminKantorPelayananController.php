<?php

class AdminKantorPelayananController extends \BaseController{

    public function index()
    {
        $kantor_pelayanans = KantorPelayanan::orderBy('name','asc')->get();;
        return View::make('admins.kantorpelayanan.index', compact('kantor_pelayanans'));
    }

    public function create()
    {
        return View::make('admins.kantorpelayanan.create');
    }


    public function store()
    {
        $validator = Validator::make($data = Input::all(), KantorPelayanan::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        if(KantorPelayanan::create($data)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.kantorpelayanan.create')->with('message', 'Informasi kantor pelayanan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.kantorpelayanan.index')->with('message', 'Informasi kantor pelayanan <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kantor pelayanan.');
    }

    public function edit($id)
    {
        $kantor_pelayanan = KantorPelayanan::find($id);

        return View::make('admins.kantorpelayanan.edit', compact('kantor_pelayanan'));
    }

    public function update($id)
    {
        //validasi
        $validator = Validator::make($data = Input::all(), KantorPelayanan::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $kantor_pelayanan = KantorPelayanan::findOrFail($id);

        //simpan
        if($kantor_pelayanan->update($data)) {
            if (Input::Get('simpan2'))
                return Redirect::route('admins.kantorpelayanan.create')->with('message', 'Informasi kantor pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.kantorpelayanan.index')->with('message', 'Informasi kantor pelayanan <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }
        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan informasi kantor pelayanan.');
    }

    public function destroy()
    {
        $id = Input::get('id');

        if(KantorPelayanan::destroy($id))
            return Redirect::route('admins.kantorpelayanan.index')->with('message', 'Informasi kantor pelayanan telah berhasil di hapus.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kantor pelayanan.');
    }
}