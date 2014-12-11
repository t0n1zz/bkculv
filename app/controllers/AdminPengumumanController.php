<?php

class AdminPengumumanController extends \BaseController{

    /**
     * Display a listing of the resource.
     * GET /kategoriartikels
     *
     * @return Response
     */
    public function index()
    {
        $pengumumans = Pengumuman::orderBy('urutan','asc')->get();;
        return View::make('admins.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /kategoriartikels
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Pengumuman::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $name = Input::get('name');

        if(Pengumuman::create($data))
            return Redirect::route('admins.pengumuman.index')->with('message', 'Pengumuman <b><i>' .$name. '</i></b> Telah berhasil ditambah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan pengumuman.');
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
        $validator = Validator::make($data = Input::all(), Pengumuman::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $name = Input::get('name');
        $id = Input::get('id');
        $Pengumuman = Pengumuman::findOrFail($id);

        //simpan
        if($Pengumuman->update($data))
            return Redirect::route('admins.pengumuman.index')->with('message', 'Pengumuman  <b><i>' .$name. '</i></b> Telah berhasil diubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan pengumuman.');
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

        if(Pengumuman::destroy($id)) {
            return Redirect::route('admins.pengumuman.index')->with('message', 'Pengumuman telah berhasil di hapus.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan pengumuman.');
    }

    public function update_urutan()
    {
        $id = Input::get('id');
        $urutan = Input::get('urutan');
        $Pengumuman = Pengumuman::findOrFail($id);
        $cariurutan = Pengumuman::where('urutan','=',$urutan)->get()->first();

        if(!empty($cariurutan) && $Pengumuman->urutan != $urutan) {
            $Pengumuman->urutan = $urutan;
            $Pengumuman->update();

            $totals = Pengumuman::select(array('urutan'))->orderBy('urutan', 'asc')->get();
            $jumlah = $totals->count();
            $i = 0;
            $array = array();
            $array2 = array();
            foreach ($totals as $total) {
                $i++;
                $array[] = $i;
                $array2[] = $total->urutan;
            }

            $result = array_diff($array, $array2);

            $value = array_first($result, function($value)
            {
                return $value;
            },$jumlah + 1);
        /*
            echo '<pre>';
            echo var_dump($value); // <---- or toJson()
            echo '</pre>';
        }
        */

            $ubahurutan = Pengumuman::find($cariurutan->id);
            $ubahurutan->urutan = $value;
            $ubahurutan->update();

            return Redirect::route('admins.pengumuman.index')->with('message', 'Urutan pengumuman telah berhasil diubah.');
        }else{
            $Pengumuman->urutan = $urutan;
            //simpan
            if($Pengumuman->update())
                return Redirect::route('admins.pengumuman.index')->with('message', 'Urutan pengumuman telah berhasil diubah.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan pengumuman.');

    }
}