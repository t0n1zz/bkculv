<?php

class Staff_cuprimer extends \Eloquent{
    
    protected $table = 'staff_cuprimer';
    
    public static $rules = [
        'name'=>'required',
        'jabatan'=>'required',
        'cu'=>'required',
        'kelamin'=>'required'
    ];
    
    protected $fillable = [
        'name','jabatan','cu','periode','tempat_lahir','tanggal_lahir','kelamin',
        'agama','pendidikan','status','asal_cu','jabatan_asal_cu','alamat','kota',
        'telp','hp','email'
    ];

    public function Cuprimer(){
        return $this->belongsTo('cuprimer','cu','id');
    }
}