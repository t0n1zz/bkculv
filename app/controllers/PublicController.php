<?php

class PublicController extends \BaseController{

    public function index(){

        $artikelpilihans = Artikel::where('pilihan', '=', '1')->get();

        $beritaBKCUs = Artikel::with('KategoriArtikel')
            ->where('pilihan','=','0')
            ->where('kategori','=','2')
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')
            ->take(3)->get();
        $beritaCUs = Artikel::with('KategoriArtikel')
            ->where('pilihan','=','0')
            ->where('kategori','=','3')
            ->where('status','=','1')
            ->orderBy('created_at', 'desc')
            ->take(3)->get();

        $pelayanans = Pelayanan::take(3)->get();
        $kegiatans = kegiatan::take(5)
            ->orderBy('tanggal','desc')
            ->get();
        $gambarkegiatans = GambarKegiatan::all();

        $beritas = KategoriArtikel::with(array('Artikel' => function($query)
        {
            $query->where('pilihan', '=', '0');
            $query->where('status', '=', '1');
        }))->whereNotIn('id',array('1','2','3','4','8'))->get();

        //Cache::forget(Artikel::getCacheKey());

        /*
        echo '<pre>';
        var_dump($beritas->toArray()); // <---- or toJson()
        echo '</pre>';
        */

        return View::make('index',compact(
            'artikelpilihans','beritaBKCUs','beritaCUs',
            'pelayanans','kegiatans','gambarkegiatans','beritas'
        ));

    }

    public function artikel($id){
        $artikels = Artikel::with('KategoriArtikel')
            ->where('kategori','=',$id)
            ->where('status','=','1')
            ->whereNotIn('kategori',array('1','8'))
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
        $kegiatans = kegiatan::orderBy('tanggal','desc')->get();

        return View::make('agenda',compact('kegiatans'));
    }

    public function profil(){
        $kantor_pelayanans = KantorPelayanan::all();

        return View::make('profil',compact('kantor_pelayanans'));
    }

    public function tim(){
        $penguruses = Staff::where('tingkat','=','1')->get();
        $pengawases = Staff::where('tingkat','=','2')->get();
        $manajemens = Staff::where('tingkat','=','3')->get();

        return View::make('tim',compact('manajemens','penguruses','pengawases'));
    }

    public function sejarah(){
        $sejarahs = Artikel::where('kategori','=','8')->get();

        return View::make('sejarah',compact('sejarahs'));
    }

    public function jejaring(){
        $jejarings = WilayahCuprimer::with('Cuprimer')
                    ->orderBy('name','asc')
                    ->get();

        return View::make('jejaring',compact('jejarings'));
    }

    public function hymnecu(){
        return View::make('hymne');
    }

    public function getcari(){
        $key = Input::get('q');
        $artikels = Artikel::where('judul','LIKE','%' .$key. '%')->where('status','=',1)->paginate(12);

        return View::make('cari', compact('artikels','key'));
    }
}