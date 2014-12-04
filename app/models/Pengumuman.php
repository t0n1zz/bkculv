<?php

class Pengumuman extends \Eloquent {
    
    protected $table = 'pengumuman';
    
    public static $rules = [
        'name' => 'required|between:5,160'
    ];
    
    protected $fillable = ['name','penulis','urutan'];

    public function Admin(){
        return $this->belongsTo('Admin','penulis','id');
    }
}