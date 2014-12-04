<?php

class KategoriArtikel extends \Eloquent {
    
    protected $table = 'kategori_artikel';
    
    public static $rules = [
        'name' => 'required|between:3,50'
    ];
    
    protected $fillable = ['name','jumlah'];

    public function Artikel(){
        return $this->hasMany('Artikel','kategori','id');
    }
}