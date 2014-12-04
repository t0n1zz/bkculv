<?php

class Staff extends \Eloquent {
    
    protected $table = 'staff';
    
    public static $rules = [
        'name' => 'required|min:3',
        'gambar' => 'image|mimes:jpeg,jpg,png,bmp'
    ];
    
    protected $fillable = ['name','jabatan','tingkat','gambar'];
}