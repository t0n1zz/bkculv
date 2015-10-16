<?php

class AdminArtikelController extends \BaseController{

    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    protected $status ="";

    public function index()
    {
        $artikels = Artikel::with('kategoriartikel')->get();
        $kategoriartikels = KategoriArtikel::orderBy('name','asc')->get();
        $is_kategori = false;

        return View::make('admins.artikel.index', compact('artikels','kategoriartikels','is_kategori'));
    }

    public function index_kategori($id){

        $artikels = Artikel::with('kategoriartikel')->where('kategori','=', $id)->get();
        $kategoriartikels = KategoriArtikel::orderBy('name','asc')->get();
        $is_kategori = true;
        //dd($artikels);
        return View::make('admins.artikel.index', compact('artikels','kategoriartikels','is_kategori'));
    }

    /**
     * Show the form for creating a new artikel
     *
     * @return Response
     */
    public function create()
    {
        $kategori_artikel = KategoriArtikel::orderBy('name','asc')->get();

        return View::make('admins.artikel.create', compact('kategori_artikel'));
    }

    /**
     * Store a newly created artikel in storage.
     *
     * @return Response
     */
    public function store()
    {


        $validator = Validator::make($data = Input::all(), Artikel::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $judul = Input::get('judul');

        $artikel = new Artikel;
        $data2 = $this->input_data($artikel,$data);

        if($this->status !="")
            return Redirect::back()->withInput()->with('errormessage',$this->status);

        try{
            Artikel::create($data2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

        if(Input::Get('simpan2'))
            return Redirect::route('admins.artikel.create')->with('message', 'Artikel <b><i>' .$judul. '</i></b> Telah berhasil ditambah.');
        else
            return Redirect::route('admins.artikel.index')->with('message', 'Artikel <b><i>' .$judul. '</i></b> Telah berhasil ditambah.');
    }

    /**
     * Show the form for editing the specified artikel.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $artikel = Artikel::find($id);
        $kategori_artikel = KategoriArtikel::orderBy('name','asc')->get();

        return View::make('admins.artikel.edit', compact('artikel','kategori_artikel'));
    }

    /**
     * Update the specified artikel in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $artikel = Artikel::findOrFail($id);

        //dd(Input::all());

        //validasi
        $validator = Validator::make($data = Input::all(), Artikel::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $judul = Input::get('judul');
        $data2 = $this->input_data($artikel,$data);

        if($this->status != "")
            return Redirect::back()->withInput()->with('errormessage',$this->status);

        try{
            $artikel->update($data2);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }


        if (Input::Get('simpan2'))
            return Redirect::route('admins.artikel.create')->with('message', 'Artikel <b><i>' . $judul . '</i></b> Telah berhasil diubah.');
        else
            return Redirect::route('admins.artikel.index')->with('message', 'Artikel <b><i>' . $judul . '</i></b> Telah berhasil diubah.');
    }


    public function input_data($artikel,$data){

        //kategori
        $kategori = Input::get('kategori');
        if($kategori == "tambah"){
            $KategoriArtikel = new KategoriArtikel;
            $KategoriArtikel->name = Input::get('kategori_baru');
            if($KategoriArtikel->save()){
                $last_id = $KategoriArtikel->id;

                $oldkategori = $artikel->kategori;
                if($oldkategoriartikel = KategoriArtikel::find($oldkategori)){
                    $oldkategoriartikel->jumlah -= 1;
                    $oldkategoriartikel->update();
                }

                //$artikel->kategori = $last_id;
                array_set($data,'kategori',$last_id);

                $newkategori = $last_id;
                if($newkategori == 0){ $newkategori = 1; }
                if($newkategoriartikel = KategoriArtikel::find($newkategori)){
                    $newkategoriartikel->jumlah +=1;
                    $newkategoriartikel->update();
                }
            }

        }else{
            $oldkategori = $artikel->kategori;
            if($oldkategoriartikel = KategoriArtikel::find($oldkategori)){
                $oldkategoriartikel->jumlah -= 1;
                $oldkategoriartikel->update();
            }

            $newkategori = $kategori;
            if($newkategori == 0){ $newkategori = 1; }
            if($newkategoriartikel = KategoriArtikel::find($newkategori)){
                $newkategoriartikel->jumlah +=1;
                $newkategoriartikel->update();
            }

            //$artikel->kategori = $newkategori;
            array_set($data,'kategori',$newkategori);
        }

        //gambar
        $gambarutama = Input::get('gambarutama');
        if($gambarutama == 1) {
            try {
                $img = Input::file('gambar');
                if (!is_null($img)) {
                    $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                    if ($this->save_image($img, $artikel, $filename))
                        array_set($data,'gambar',$filename);
                    else
                        return false;
                }else{
                    $filename = $artikel->gambar;
                    array_set($data,'gambar',$filename);
                }
            } catch (Exception $e) {
                $this->status = $e->getMessage();
            }
        }else{
            if(!empty($artikel->gambar)){
                $path = public_path('images_artikel/');
                File::delete($path . $artikel->gambar);
                array_set($data,'gambar',"");
            }
            array_set($data,'gambar',"");
        }

        return $data;
    }

    public function update_kategori(){
        $id = Input::get('id');
        $artikel = Artikel::findOrFail($id);

        $oldkategori = $artikel->kategori;
        if($oldkategoriartikel = KategoriArtikel::find($oldkategori)){
            $oldkategoriartikel->jumlah -= 1;
            $oldkategoriartikel->update();
        }

        $newkategori = Input::get('kategori');
        if($newkategori == 0){ $newkategori = 1; }
        if($newkategoriartikel = KategoriArtikel::find($newkategori)){
            $newkategoriartikel->jumlah +=1;
            $newkategoriartikel->update();
        }


        $artikel->kategori = $newkategori;
        $judul = $artikel->judul;

        //simpan
        if($artikel->update())
            return Redirect::route('admins.artikel.index')->with('message', 'Kategori artikel<b><i>' .$judul. '</i></b> Telah berhasil di ubah.');

        Cache::forget('artikel');
        Cache::forget('kategoriartikel');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan kategori artikel.');
    }

    public function update_status(){
        $id = Input::get('id');
        $artikel = Artikel::findOrFail($id);
        $artikel->status = Input::get('status');
        $judul = $artikel->judul;

        //simpan
        if($artikel->update())
            return Redirect::route('admins.artikel.index')->with('message', 'Status artikel <b><i>' .$judul. '</i></b> Telah berhasil di ubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan status artikel.');
    }

    public function update_pilihan(){
        $id = Input::get('id');
        $artikel = Artikel::findOrFail($id);
        $artikel->pilihan = Input::get('pilihan');
        $judul = $artikel->judul;

        //simpan
        if($artikel->update())
            return Redirect::route('admins.artikel.index')->with('message', 'Artikel <b><i>' .$judul. '</i></b> Telah menjadi artikel pilihan.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan status artikel.');
    }

    /**
     * Remove the specified artikel from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $id = Input::get('id');
        $artikel = Artikel::findOrFail($id);
        $path = public_path('images_artikel/');

        $oldkategori = $artikel->kategori;
        if($oldkategoriartikel = KategoriArtikel::find($oldkategori)){
            $oldkategoriartikel->jumlah -= 1;
            $oldkategoriartikel->update();
        }

        try{
            File::delete($path . $artikel->gambar);
            Artikel::destroy($id);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

        return Redirect::route('admins.artikel.index')->with('message', 'Artikel Telah berhasil di hapus.');;
    }


    function save_image($img,$artikel,$filename){

        list($width, $height) = getimagesize($img);

        $path = public_path('images_artikel/');
        File::delete($path . $artikel->gambar);

        if($width > 720){
            if(Image::make($img->getRealPath())->resize(720, null, function ($constraint) {
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