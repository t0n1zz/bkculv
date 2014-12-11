<?php

class Download extends \Eloquent{
    
    protected $table = 'download';
    
    public static $rules = [
        'name' => 'required|between:3,100'
    ];
    
    protected $fillable = ['name','filename','content'];

}