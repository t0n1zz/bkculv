<?php

class Saran extends \Eloquent{
    
    protected $table = 'saran';
    
    public static $rules = [
        'name' => 'required',
        'content' => 'required|min:5'
    ];
    
    protected $fillable = ['name','content'];

}