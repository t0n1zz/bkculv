<?php

class AdminKantorPelayananController extends \BaseController{

    public function index()
    {
        $kantor_pelayanans = KantorPelayanan::all();
        return View::make('admins.kantorpelayanan.index', compact('kantor_pelayanans'));
    }

    public function create()
    {
        $kantor_pelayanan = KantorPelayanan::all();

        return View::make('admins.kantorpelayanan.create', compact('kantor_pelayanan'));
    }


    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
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
        }elseif(Input::get('batal')){
            return Redirect::route('admins.kantorpelayanan.index');
        }
    }

    public function edit($id)
    {
        $kantor_pelayanan = KantorPelayanan::find($id);

        return View::make('admins.kantorpelayanan.edit', compact('kantor_pelayanan'));
    }

    public function update($id)
    {
        if(Input::get('simpan') || Input::get('simpan2')){
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
        }elseif(Input::get('batal')){
            return Redirect::route('admins.kantorpelayanan.index');
        }
    }

    public function destroy()
    {
        $id = Input::get('id');

        if(KantorPelayanan::destroy($id))
            return Redirect::route('admins.kantorpelayanan.index')->with('message', 'Informasi kantor pelayanan telah berhasil di hapus.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kantor pelayanan.');
    }
}