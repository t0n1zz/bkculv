<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class Admin extends Eloquent implements UserInterface, RemindableInterface {

    // This is trait for using entrust
    use HasRole;

	use UserTrait, RemindableTrait;

    public static $rules = [
        'username' => 'required|min:5',
        'password' => 'required'
    ];

    protected $fillable = ['username','password',
        'name','logout','login',
        'cu','status'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getGambar()
    {
        return $this->gambar;
    }

    public function getLogout()
    {
        return $this->logout;
    }

    public function cuprimer(){
        return $this->belongsTo('Cuprimer','cu','id');
    }
}
