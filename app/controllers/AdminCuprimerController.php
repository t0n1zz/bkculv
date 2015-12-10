<?php

class AdminCuprimerController extends \BaseController{

    protected $kelaspath = 'cuprimer';
    protected $imagepath = 'images_cu/';

    public function index()
    {
        try{
            $datas = Cuprimer::with('WilayahCuprimer')
                ->orderBy('name','asc')
                ->get();

            $datas2 = WilayahCuprimer::all();
            $is_wilayah = false;

            return View::make('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_wilayah'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function index_wilayah($id)
    {
        try{
            $datas = Cuprimer::with('WilayahCuprimer')
                ->where('wilayah','=', $id)
                ->orderBy('name','asc')
                ->get();

            $datas2 = WilayahCuprimer::all();
            $is_wilayah = true;
            return View::make('admins.'.$this->kelaspath.'.index', compact('datas','datas2','is_wilayah'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $datas2 = WilayahCuprimer::orderBy('name','asc')->get();
            return View::make('admins.'.$this->kelaspath.'.create',compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $kelas = new Cuprimer();
            $name = Input::get('name');

            $data2 = $this->input_data($kelas,$data);

            Cuprimer::create($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil ditambah.');

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan CU.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $data = Cuprimer::find($id);
            $datas2 = WilayahCuprimer::orderBy('name', 'asc')->get();

            return View::make('admins.'.$this->kelaspath.'.edit', compact('data', 'datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            //get php max file upload size
            $file_max = ini_get('upload_max_filesize');
            $file_max_str_leng = strlen($file_max);
            $file_max_meassure_unit = substr($file_max,$file_max_str_leng - 1,1);
            $file_max_meassure_unit = $file_max_meassure_unit == 'K' ? 'kb' : ($file_max_meassure_unit == 'M' ? 'mb' : ($file_max_meassure_unit == 'G' ? 'gb' : 'unidades'));
            $file_max = substr($file_max,0,$file_max_str_leng - 1);
            $file_max = intval($file_max);

            //validasi
            $validator = Validator::make($data = Input::all(), Cuprimer::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $kelas = Cuprimer::findOrFail($id);
            $data2 = $this->input_data($kelas,$data);

            //simpan
            $kelas->update($data2);

            if (Input::Get('simpan2'))
                return Redirect::route('admins.cuprimer.create')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.cuprimer.index')->with('message', 'CU <b><i>' . $name . '</i></b> Telah berhasil diubah.');

        }catch (Exception $e){
            if($e->getMessage() == "getimagesize(): Filename cannot be empty")
                return Redirect::back()->withInput()->with('errormessage','Pastikan ukuran file gambar tidak lebih besar dari ' .$file_max. ' ' .$file_max_meassure_unit);
            else
                return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    public function input_data($kelas,$data)
    {
        $nama = str_limit(preg_replace('/\s+/', '',Input::get('name')),10);
        $wilayah = Input::get('wilayah');

        $timestamp = strtotime(Input::get('ultah'));
        $tanggal = date('Y-m-d',$timestamp);
        array_set($data,'ultah',$tanggal);

        $timestamp2 = strtotime(Input::get('bergabung'));
        $tanggal2 = date('Y-m-d',$timestamp2);
        array_set($data,'bergabung',$tanggal2);

        //kategori

        if($wilayah == "tambah"){
            $wilayahcuprimer = new WilayahCuprimer();
            $wilayahcuprimer->name = Input::get('wilayah_baru');
            $wilayahcuprimer->save();
            $last_id = $wilayahcuprimer->id;
            array_set($data,'wilayah',$last_id);
        }else {
            array_set($data,'wilayah',$wilayah);
        }

        //gambar
        $img = Input::file('gambar');
        if (!is_null($img)) {
            $filename = $nama . "-" . date('Y-m-d') . ".jpg";

            if ($this->save_image($img, $kelas, $filename))
                array_set($data,'gambar',$filename);
            else
                return false;
        }else{
            $filename = $kelas->gambar;
            array_set($data,'gambar',$filename);
        }

        //logo
        $img2 = Input::file('logo');
        if (!is_null($img2)) {
            $filename = $nama ."-logo" . "-" . date('Y-m-d') . ".jpg";

            if ($this->save_image($img2, $kelas, $filename))
                array_set($data,'logo',$filename);
            else
                return false;
        }else{
            $filename = $kelas->logo;
            array_set($data,'logo',$filename);
        }

        return $data;
    }

    public function destroy()
    {
        try{
        $id = Input::get('id');

        Cuprimer::destroy($id);

        return Redirect::route('admins.'.$this->kelaspath.'.index')->with('message', 'Informasi kegiatan telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    function save_image($img,$kelas,$filename){

        $path = public_path($this->imagepath);
        File::delete($path . $kelas->gambar);

        if(Image::make($img->getRealPath())->resize(360, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path . $filename))
            return true;
        else
            return false;
    }
}