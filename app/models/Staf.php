<?php

class Staf extends \Eloquent {
    
    protected $table = 'staf';
    
    public static $rules = [
        'name'=>'required',
        'jabatan'=>'required',
        'tingkat'=>'required',
        'cu'=>'required',
        'email' =>  'email'
    ];
    
    protected $fillable = [
        'name','jabatan','tingkat','cu','periode1','periode2','tempat_lahir','tanggal_lahir','kelamin',
        'agama','pendidikan','status','alamat','kota','gambar',
        'telp','hp','email'
    ];

    public function cuprimer(){
        return $this->belongsTo('Cuprimer','cu','id');
    }
}