<?php

class Staff extends \Eloquent {
    
    protected $table = 'staff';
    
    public static $rules = [
        'name' => 'required|min:3'
    ];
    
    protected $fillable = ['name','jabatan','tingkat','gambar'];
}