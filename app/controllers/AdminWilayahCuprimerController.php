<?php

class AdminWilayahCuprimerController extends \BaseController{

    public function index()
    {
        $wilayahcuprimers = WilayahCuprimer::orderBy('name','asc')->get();;
        return View::make('admins.wilayahcuprimer.index', compact('wilayahcuprimers'));
    }

    public function store()
    {
        $validator = Validator::make($data = Input::all(), WilayahCuprimer::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        if(WilayahCuprimer::create($data))
            return Redirect::route('admins.wilayahcuprimer.index')->with('message', 'Wilayah CU <b><i>' .$name. '</i></b> Telah berhasil ditambah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan wilayah cu.');
    }


    public function update()
    {
        //validasi
        $validator = Validator::make($data = Input::all(), WilayahCuprimer::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $id = Input::get('id');
        $wilayahcuprimer = WilayahCuprimer::findOrFail($id);

        //simpan
        if($wilayahcuprimer->update($data))
            return Redirect::route('admins.wilayahcuprimer.index')->with('message', 'Wilayah cu  <b><i>' .$name. '</i></b> Telah berhasil diubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan wilayah cu.');
    }


    public function destroy()
    {
        $id = Input::get('id');
        $wilayahcuprimer = WilayahCuprimer::find($id);

        if($wilayahcuprimer->jumlah == 0) {
            if(WilayahCuprimer::destroy($id))
                return Redirect::route('admins.wilayahcuprimer.index')->with('message', 'Wilayah CU telah berhasil di hapus.');

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan wilayah CU.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terdapat CU pada wilayah ini, silahkan ganti terlebih dahulu.');
    }
}