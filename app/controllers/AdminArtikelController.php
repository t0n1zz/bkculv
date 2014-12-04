<?php

class AdminArtikelController extends \BaseController{

    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        $artikels = Artikel::with('kategoriartikel')->get();
        $kategoriartikels = KategoriArtikel::all();
        $is_kategori = false;

        return View::make('admins.artikel.index', compact('artikels','kategoriartikels','is_kategori'));
    }

    public function index_kategori($id){

        $artikels = Artikel::with('kategoriartikel')->where('kategori','=', $id)->get();
        $kategoriartikels = KategoriArtikel::all();
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
        $kategori_artikel = KategoriArtikel::all();

        return View::make('admins.artikel.create', compact('kategori_artikel'));
    }

    /**
     * Store a newly created artikel in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Artikel::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $judul = Input::get('judul');

            $artikel = new Artikel;
            $this->input_data($artikel,$judul);

            if($artikel->save()){
                if(Input::Get('simpan2'))
                    return Redirect::route('admins.artikel.create')->with('message', 'Artikel <b><i>' .$judul. '</i></b> Telah berhasil ditambah.');
                else
                    return Redirect::route('admins.artikel.index')->with('message', 'Artikel <b><i>' .$judul. '</i></b> Telah berhasil ditambah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan artikel.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.artikel.index');
        }
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
        $kategori_artikel = KategoriArtikel::all();

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

        //get php max file upload size
        $file_max = ini_get('upload_max_filesize');
        $file_max_str_leng = strlen($file_max);
        $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
        $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
        $file_max = substr($file_max,0,$file_max_str_leng - 1);
        $file_max = intval($file_max);

        if(Input::get('simpan') || Input::get('simpan2')){
            //dd(Input::all());

            //validasi
            $validator = Validator::make($data = Input::all(), Artikel::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $judul = Input::get('judul');

            $this->input_data($artikel,$judul);

            //simpan
            if($artikel->update()) {
                if (Input::Get('simpan2'))
                    return Redirect::route('admins.artikel.create')->with('message', 'Artikel <b><i>' . $judul . '</i></b> Telah berhasil diubah.');
                else
                    return Redirect::route('admins.artikel.index')->with('message', 'Artikel <b><i>' . $judul . '</i></b> Telah berhasil diubah.');
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan artikel.');

        }elseif(Input::get('batal')){
            return Redirect::route('admins.artikel.index');
        }
    }

    public function input_data($artikel,$judul){

        $artikel->judul = $judul;
        $artikel->content = Input::get('content');
        $artikel->status = Input::get('status');
        $artikel->pilihan = Input::get('pilihan');
        $artikel->penulis = Input::get('penulis');

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

                $artikel->kategori = $last_id;

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

            $artikel->kategori = $newkategori;
        }



        //gambar
        $gambarutama = Input::get('gambarutama');
        if($gambarutama == 1) {
            try {
                $img = Input::file('gambar');
                if (!empty($img)) {
                    $filename = str_random(10) . "-" . date('Y-m-d') . ".jpg";

                    if ($this->save_image($img, $artikel, $filename))
                        $artikel->gambar = $filename;
                    else
                        return Redirect::back()->withInput()->with('errormessage', 'Terjadi kesalahan dalam penyimpanan gambar.');
                }
            } catch (Exception $e) {
                return Redirect::back()->withInput()->with('errormessage', 'Ukuran gambar harus lebih kecil dari ' . $file_max . " " . $file_max_meassure_unit);
            }
        }else{
            if(!empty($artikel->gambar)){
                $path = public_path('images_artikel/');
                File::delete($path . $artikel->gambar);
                $artikel->gambar = null;
            }
        }
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

        File::delete($path . $artikel->gambar);
        Artikel::destroy($id);


        return Redirect::route('admins.artikel.index')->with('message', 'Artikel Telah berhasil di hapus.');;
    }


    function save_image($img,$artikel,$filename){

        list($width, $height) = getimagesize($img);

        $path = public_path('images_artikel/');
        File::delete($path . $artikel->gambar);

        if($width > 400){
            if(Image::make($img->getRealPath())->resize(400, null, function ($constraint) {
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