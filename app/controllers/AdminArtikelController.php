<?php

class AdminArtikelController extends \BaseController{

    protected $kelaspath = 'artikel';
    protected $imagepath = 'images_artikel/';
    /**
     * Display a listing of artikels
     *
     * @return Response
     */
    public function index()
    {
        try{
            $datas = Artikel::with('kategoriartikel')->orderBy('judul','asc')->get();
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();
            $is_kategori = false;

            return View::make('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_kategori'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_kategori($id)
    {
        try{
            $datas = Artikel::with('kategoriartikel')->where('kategori','=', $id)->get();
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();
            $is_kategori = true;

            return View::make('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_kategori'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new artikel
     *
     * @return Response
     */
    public function create()
    {
        try{
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();

            return View::make('admins.'.$this->kelaspath.'.create', compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }

    }

    /**
     * Store a newly created artikel in storage.
     *
     * @return Response
     */
    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Artikel::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $judul = Input::get('judul');

            $kelas = new Artikel;
            $data2 = $this->input_data($kelas,$data);

            Artikel::create($data2);

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Artikel <b>' .$judul. '</b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Artikel <b>' .$judul. '</b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
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
        try{
            $data = Artikel::find($id);
            $datas2 = KategoriArtikel::orderBy('name','asc')->get();

            return View::make('admins.'.$this->kelaspath.'.edit', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Update the specified artikel in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try{
            $file_max = ini_get('upload_max_filesize');
            $file_max_str_leng = strlen($file_max);
            $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
            $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
            $file_max = substr($file_max,0,$file_max_str_leng - 1);
            $file_max = intval($file_max);

            $kelas = Artikel::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Artikel::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $judul = Input::get('judul');
            $data2 = $this->input_data($kelas,$data);

            $kelas->update($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Artikel <b>' . $judul . '</b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Artikel <b>' . $judul . '</b> Telah berhasil diubah.');
        }catch (Exception $e){
            if($e->getMessage() == "getimagesize(): Filename cannot be empty")
                return Redirect::back()->withInput()->with('errormessage','Pastikan ukuran file gambar tidak lebih besar dari ' .$file_max. ' ' .$file_max_meassure_unit);
            else
                return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function input_data($kelas,$data)
    {
        $nama = str_limit(preg_replace('/\s+/', '',Input::get('judul')),10);
        $kategori = Input::get('kategori');

        if($kategori == "tambah"){
            $KategoriArtikel = new KategoriArtikel;
            $KategoriArtikel->name = Input::get('kategori_baru');
            $KategoriArtikel->save();
            $last_id = $KategoriArtikel->id;
            array_set($data,'kategori',$last_id);
        }else{
            array_set($data,'kategori',$kategori);
        }

        //gambar
        $gambarutama = Input::get('gambarutama');
        if ($gambarutama == 1) {
            $img = Input::file('gambar');
            if (!is_null($img)) {
                $formatedname1 = $nama.str_random(3).date('Y-m-d');
                $filename = $formatedname1.".jpg";
                $filename2 = $formatedname1."n.jpg";

                $this->save_image($img, $kelas, $filename,$filename2);
                array_set($data, 'gambar', $filename);
            } else {
                $filename = $kelas->gambar;
                array_set($data, 'gambar', $filename);
            }
        } else {
            if (!empty($kelas->gambar)) {
                $path = public_path($this->imagepath);
                File::delete($path . $kelas->gambar);
                array_set($data, 'gambar', "");
            }
            array_set($data, 'gambar', "");
        }

        return $data;
    }

    public function update_kategori()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $newkategori = Input::get('kategori');
            $kelas->kategori = $newkategori;
            $judul = $kelas->judul;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Kategori artikel <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_status()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $judul = $kelas->judul;

            if(Input::Get('btn1'))
                $kelas->status = 1;
            else
                $kelas->status = 0;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Status publikasi artikel <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update_pilihan()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $judul = $kelas->judul;

            if(Input::Get('btn1'))
                $kelas->pilihan = 1;
            else
                $kelas->pilihan = 0;

            $kelas->update();

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Status artikel pilihan <b>' .$judul. '</b> Telah berhasil di ubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    /**
     * Remove the specified artikel from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Artikel::findOrFail($id);
            $path = public_path($this->imagepath);

            File::delete($path . $kelas->gambar);
            File::delete($path . $kelas->gambar .".jpg");
            File::delete($path . $kelas->gambar ."n.jpg");

            Artikel::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage','Artikel Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    function save_image($img,$kelas,$filename,$filename2)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar);
        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");

        if($width > 720){
            Image::make($img->getRealPath())->resize(720, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path . $filename);
        }else{
            Image::make($img->getRealPath())->save($path . $filename);
        }

        Image::make($img->getRealPath())->fit(200,200)->save($path . $filename2);
    }
}