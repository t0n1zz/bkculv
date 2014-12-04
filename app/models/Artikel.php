<?php

class Artikel extends \Eloquent {
    
    protected $table = 'artikel';
    
    public static $rules = [
        'judul' => 'required|min:5',
        'content' => 'required|min:10',
        'gambar' => 'image|mimes:jpeg,jpg,png,bmp'
    ];
    
    protected $fillable = ['judul','content','kategori','penulis','status','gambar','pilihan'];

    public function KategoriArtikel(){
        return $this->belongsTo('KategoriArtikel','kategori','id');
    }

    public function Admin(){
        return $this->belongsTo('Admin','penulis','id');
    }
}