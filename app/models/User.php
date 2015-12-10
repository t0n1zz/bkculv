<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use HasRole;
	use UserTrait, RemindableTrait;

    public static $rules = [
        'username' => 'required'
    ];

    protected $fillable = [
        'username','password','name','gambar','cu'
    ];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getGambar(){
        return $this->gambar;
    }

    public function getLogout(){
        return $this->logout;
    }
}
