<?php

class AdminKategoriArtikelController extends \BaseController{

    /**
     * Display a listing of the resource.
     * GET /kategoriartikels
     *
     * @return Response
     */
    public function index()
    {
        $kategori_artikels = KategoriArtikel::all();
        return View::make('admins.kategoriartikel.index', compact('kategori_artikels'));
    }
    /**
     * Store a newly created resource in storage.
     * POST /kategoriartikels
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        if(KategoriArtikel::create($data))
            return Redirect::route('admins.kategoriartikel.index')->with('message', 'Kategori Artikel <b><i>' .$name. '</i></b> Telah berhasil ditambah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan kategori artikel.');
    }

    /**
     * Update the specified resource in storage.
     * PUT /kategoriartikels/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        //validasi
        $validator = Validator::make($data = Input::all(), KategoriArtikel::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $id = Input::get('id');
        $kategori_artikel = KategoriArtikel::findOrFail($id);

        //simpan
        if($kategori_artikel->update($data))
            return Redirect::route('admins.kategoriartikel.index')->with('message', 'Kategori artikel  <b><i>' .$name. '</i></b> Telah berhasil diubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan kategori artikel.');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /kategoriartikels/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $id = Input::get('id');
        $kategori_artikel = KategoriArtikel::find($id);

        if($kategori_artikel->jumlah == 0) {
            if(KategoriArtikel::destroy($id))
                return Redirect::route('admins.kategoriartikel.index')->with('message', 'Kategori artikel telah berhasil di hapus.');

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan kategori artikel.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terdapat artikel pada kategori ini, silahkan ganti terlebih dahulu.');
    }
}