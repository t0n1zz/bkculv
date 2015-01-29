<?php

class kegiatan extends \Eloquent {
    
    protected $table = 'kegiatan';
    
    public static $rules = [
        'name' => 'required|min:5',
        'wilayah' => 'required',
        'tempat' => 'required',
        'sasaran' => 'required',
        'tanggal' => 'required|date',
        'tanggal2' => 'required|date'
    ];
    
    protected $fillable = [
        'name','penulis','tanggal','tanggal2','wilayah','tempat','sasaran','fasilitator'
    ];

    public function Admin(){
        return $this->belongsTo('Admin','penulis','id');
    }
}