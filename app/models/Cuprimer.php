<?php

class Cuprimer extends \Eloquent {
    
    protected $table = 'cuprimer';
    
    public static $rules = [
        'name' => 'required|min:5'
    ];
    
    protected $fillable = ['no_ba','name','badan_hukum','alamat','pos'
        ,'telp','hp','website','email','gambar','logo','app'
        ,'deskripsi','wilayah','bergabung','ultah','tp','staf'];

    public function WilayahCuprimer(){
        return $this->belongsTo('WilayahCuprimer','wilayah','id');
    }
}