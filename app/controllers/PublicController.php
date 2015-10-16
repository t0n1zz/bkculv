<?php

class PublicController extends \BaseController{

    public function index(){

        $artikelpilihans = Artikel::where('pilihan', '=', '1')->get();

        $beritaBKCUs = Artikel::with('KategoriArtikel')
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        $pelayanans = Pelayanan::take(3)->get();
        $kegiatans = kegiatan::take(5)
            ->where('status','=','0')
            ->orderBy('tanggal','asc')
            ->get();

        $date = Date::now()->format('d-m');
        $query = "SELECT  id,name FROM cuprimer WHERE DATE_FORMAT(ultah, '%d-%m') = '$date' ";
        $ultahcu = DB::select(DB::raw($query));

        Flickering::handshake();
        $gambar =  Flickering::callMethod('people.getPhotos', array('user_id' => '127271987@N07'));
        $gambar->setPerPage(20);
        $gambars = $gambar->getResults('photo');
        //$gambars = $gambar->getReponse('photo');

        //Cache::forget(Artikel::getCacheKey());

        /*
        echo '<pre>';
        var_dump($gambars); // <---- or toJson()
        echo '</pre>';
        */

        return View::make('index',compact(
            'artikelpilihans','beritaBKCUs',
            'pelayanans','kegiatans','ultahcu','gambars'
        ));
    }

    public function saran(){
        $validator = Validator::make($data = Input::all(), Saran::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(Saran::create($data))
            return Redirect::back()->with('message', 'Terima kasih atas saran dan kritiknya.');
    }

    public function artikel($id){
        $artikels = Artikel::with('KategoriArtikel')
            ->where('kategori','=',$id)
            ->where('status','=','1')
            ->whereNotIn('kategori',array('1'))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $kategori = KategoriArtikel::find($id);
        $title = $kategori->name;

        return View::make('artikel',compact('artikels','title'));
    }

    public function detail_artikel($id){
        $detail_artikel = Artikel::with('KategoriArtikel')
            ->where('status','=','1')
            ->find($id);

        $artikelbarus = Artikel::select('id','judul')
            ->where('status','=','1')
            ->whereNotIn('kategori',array('1','8'))
            ->orderBy('created_at','desc')
            ->take(5)->get();

        return View::make('detail_artikel',compact('detail_artikel','artikelbarus'));
    }

    public function berita(){
        $beritas = KategoriArtikel::whereNotIn('id',array(1,4,8))->get();

        return View::make('berita',compact('beritas'));
    }

    public function solusi($id){
        $url = URL::route('pelayanan') . '#' . $id;

        return Redirect::to($url); // domain.com/welcome#hash
    }

    public function pelayanan(){
        $pelayanans = Pelayanan::select('id','name','gambar','content')->get();

        return View::make('pelayanan',compact('pelayanans'));
    }

    public function agenda(){
        $kegiatans = kegiatan::where('status','=','0')->orderBy('tanggal','asc')->get();

        return View::make('agenda',compact('kegiatans'));
    }

    public function profil(){
        $kantor_pelayanans = KantorPelayanan::all();
        $visi = Artikel::where("id",'=','4')->first();

        return View::make('profil',compact('kantor_pelayanans','visi'));
    }

    public function pengurus(){
        $penguruses1 = Staff::where('tingkat','=','1')
            ->where('cu','=','0')
            ->where('periode1','=','2012')
            ->where('periode2','=','2014')
            ->get();
        $penguruses2 = Staff::where('tingkat','=','1')
            ->where('cu','=','0')
            ->where('periode1','=','2015')
            ->where('periode2','=','2017')
            ->get();

        return View::make('pengurus',compact('penguruses1','penguruses2'));
    }

    public function pengawas(){
        $pengawases1 = Staff::where('tingkat','=','2')
            ->where('cu','=','0')
            ->where('periode1','=','2012')
            ->where('periode2','=','2014')
            ->get();
        $pengawases2 = Staff::where('tingkat','=','2')
            ->where('cu','=','0')
            ->where('periode1','=','2015')
            ->where('periode2','=','2017')
            ->get();

        return View::make('pengawas',compact('pengawases1','pengawases2'));
    }

    public function manajemen(){
        $manajemens = Staff::where('tingkat','=','3')
            ->where('cu','=','0')
            ->get();

        return View::make('manajemen',compact('manajemens'));
    }

    public function sejarah(){
        $sejarahs = Artikel::where('kategori','=','8')->get();

        return View::make('sejarah',compact('sejarahs'));
    }

    public function anggota(){
        $jejarings = WilayahCuprimer::with('Cuprimer')
                    ->orderBy('name','asc')
                    ->get();

        return View::make('anggota',compact('jejarings'));
    }

    public function cudetail($id){
        $cudetail = Cuprimer::with('wilayahcuprimer')
                            ->where('id','=',$id)
                            ->first();

        $staffs = Staff::where('cu','=',$id)->get();

        return View::make('cudetail',compact('cudetail','staffs'));
    }

    public function hymnecu(){
        return View::make('hymne');
    }

    public function attribution(){
        return View::make('attribution');
    }

    public function download(){
        $downloads = Download::all();

        return View::make('download',compact('downloads'));
    }

    public function download_file($filename){
        $destinationPath = public_path() . "/files/";
        $file= $destinationPath . $filename;

        return Response::download($file);
    }

    public function getcari(){
        $key = Input::get('q');
        $artikels = Artikel::where('judul','LIKE','%' .$key. '%')->where('status','=',1)->paginate(12);

        return View::make('cari', compact('artikels','key'));
    }

    public function update_kegiatan(){
        $now = new Date('now');
        $now->format('Y-m-d H:i:s');
        $kegiatans = kegiatan::where('tanggal2','<',$now)->get();

        foreach($kegiatans as $kegiatan){
            $kegiatan->status = "1";
            $kegiatan->update();
        }
    }

    public function pemilihan(){
        return View::make('pemilihan');
    }
}