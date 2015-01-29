<?php

class Pelayanan extends \Eloquent {
    
    protected $table = 'pelayanan';
    
    public static $rules = [
        'name' => 'required|min:5',
        'content' => 'required|min:10'
    ];
    
    protected $fillable = ['name','gambar','content'];
}