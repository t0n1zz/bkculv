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
        'username' => 'required',
        'password' => 'required'
    ];

    protected $fillable = ['username','password','name','last_login','last_logout'];

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
}
