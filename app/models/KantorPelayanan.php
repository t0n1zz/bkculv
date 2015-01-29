<?php

class KantorPelayanan extends \Eloquent {
    
    protected $table = 'kantor_pelayanan';
    
    public static $rules = [
        'name' => 'required|min:5',
        'alamat' => 'required|min:10',
        'pos' => 'integer',
        'email' =>  'email'
    ];
    
    protected $fillable = [
        'name','alamat','alamat2','alamat3','pos','telp','fax','email'
    ];
}