<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('admins/login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

//admin permission
Route::filter('admin', function()
{
    if (! Entrust::can('admin') ) // Checks the current user
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Admin</b>.');;
    }
});
Route::filter('artikel', function()
{
    if (! Entrust::can('artikel') ) // Checks the current user
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Artikel</b>.');;
    }
});
Route::filter('cuprimer', function()
{
    if (! Entrust::can('cuprimer') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>CU Primer</b>.');;
    }
});
Route::filter('infogerakan', function()
{
    if (! Entrust::can('infogerakan') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Informasi Gerakan</b>.');;
    }
});
Route::filter('kantorpelayanan', function()
{
    if (! Entrust::can('kantorpelayanan') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Kantor Pelayanan</b>.');;
    }
});
Route::filter('kategoriartikel', function()
{
    if (! Entrust::can('kategoriartikel') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Kategori Artikel</b>.');;
    }
});
Route::filter('kegiatan', function()
{
    if (! Entrust::can('kegiatan') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Agenda</b>.');;
    }
});
Route::filter('pelayanan', function()
{
    if (! Entrust::can('pelayanan') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Pelayanan</b>.');;
    }
});
Route::filter('pengumuman', function()
{
    if (! Entrust::can('pengumuman') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Pengumuman</b>.');;
    }
});
Route::filter('staff', function()
{
    if (! Entrust::can('staff') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Staff</b>.');;
    }
});
Route::filter('wilayahcuprimer', function()
{
    if (! Entrust::can('wilayahcuprimer') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Wilayah CU Primer</b>.');;
    }
});
Route::filter('download', function()
{
    if (! Entrust::can('download') )
    {
        return Redirect::to('/admins')->with('message', 'Maaf, anda tidak punya akses ke halaman <b>Download</b>.');;
    }
});


