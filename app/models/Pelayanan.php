<?php

class Pelayanan extends \Eloquent {
    
    protected $table = 'pelayanan';
    
    public static $rules = [
        'name' => 'required|between:5,30',
        'gambar' => 'image|mimes:jpeg,jpg,png,bmp',
        'content' => 'required|min:10'
    ];
    
    protected $fillable = ['name','gambar','content'];
}