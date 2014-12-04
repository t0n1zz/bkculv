<?php

class WilayahCuprimer extends \Eloquent {
    
    protected $table = 'wilayah_cuprimer';
    
    public static $rules = [
        'name' => 'required|min:3'
    ];
    
    protected $fillable = ['name','jumlah'];

    public function Cuprimer(){
        return $this->hasMany('Cuprimer','wilayah','id');
    }
}