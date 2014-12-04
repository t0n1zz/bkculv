<?php

class Cuprimer extends \Eloquent {
    
    protected $table = 'cuprimer';
    
    public static $rules = [
        'name' => 'required|min:3',
        'content' => 'required|min:5'
    ];
    
    protected $fillable = ['name','content','wilayah','ultah'];

    public function WilayahCuprimer(){
        return $this->belongsTo('WilayahCuprimer','wilayah','id');
    }
}