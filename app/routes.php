<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',array( 'as' => 'home','uses' => 'PublicController@index'));
Route::get('pelayanan/{id}',array( 'as' => 'pelayanans','uses' => 'PublicController@solusi'));
Route::get('pelayanan',array( 'as' => 'pelayanan','uses' => 'PublicController@pelayanan'));
Route::get('kegiatan',array( 'as' => 'kegiatan','uses' => 'PublicController@agenda'));
Route::get('profil',array( 'as' => 'profil','uses' => 'PublicController@profil'));
Route::get('pengurus',array( 'as' => 'pengurus','uses' => 'PublicController@pengurus'));
Route::get('pengawas',array( 'as' => 'pengawas','uses' => 'PublicController@pengawas'));
Route::get('manajemen',array( 'as' => 'manajemen','uses' => 'PublicController@manajemen'));
Route::get('berita',array( 'as' => 'berita','uses' => 'PublicController@berita'));
Route::get('sejarah',array( 'as' => 'sejarah','uses' => 'PublicController@sejarah'));
Route::get('anggota',array('as' => 'anggota','uses' => 'PublicController@anggota'));
Route::get('cudetail/{id}',array( 'as' => 'cudetail','uses' => 'PublicController@cudetail'));
Route::get('hymnecu',array('as' => 'hymnecu','uses' => 'PublicController@hymnecu'));
Route::get('artikel/{id}',array( 'as' => 'artikel','uses' => 'PublicController@artikel'));
Route::get('detail_artikel/{id}',array( 'as' => 'detail_artikel','uses' => 'PublicController@detail_artikel'));
Route::get('cari',array('as' => 'cari','uses' => 'PublicController@getcari'));
Route::get('download',array('as' => 'download','uses' => 'PublicController@download'));
Route::get('download/{filename}',array('as' => 'file','uses' => 'PublicController@download_file'));
Route::get('attribution',array('as' => 'attribution','uses' => 'PublicController@attribution'));
//Route::get('pemilihan',array('as' => 'pemilihan','uses' => 'PublicController@pemilihan'));

//saran
Route::post('saran',array('as' => 'saran', 'uses' => 'PublicController@saran'));

//auto delete kegiatan
Route::get('update_kegiatan',array( 'as' => 'update_kegiatan','uses' => 'PublicController@update_kegiatan'));


//admin
Route::group(array('prefix' => 'admins'), function(){
    Route::get('login',array('as' => 'admins.login','uses' => 'AdminAuthController@getLogin'));
    Route::post('login',array('as' =>'admins.login.post','uses' => 'AdminAuthController@postLogin'));
    Route::get('logout',array('as' => 'admins.logout','uses' => 'AdminAuthController@getLogout'));
    Route::get('back',array('as' => 'admins.back','uses' => 'AdminAuthController@getBack'));
});

Route::get('admins',array('as' => 'admins','before' => 'auth', function()
{
    return View::make('admins.index');
}));

Route::when('admins/admin*', 'admin');
Route::when('admins/artikel*', 'artikel');
Route::when('admins/cuprimer*', 'cuprimer');
Route::when('admins/gambarkegiatan*', 'gambarkegiatan');
Route::when('admins/infogerakan*', 'infogerakan');
Route::when('admins/kantorpelayanan*', 'kantorpelayanan');
Route::when('admins/kategoriartikel*', 'kategoriartikel');
Route::when('admins/kegiatan*', 'kegiatan');
Route::when('admins/pelayanan*', 'pelayanan');
Route::when('admins/pengumuman*', 'pengumuman');
Route::when('admins/staff*', 'staff');
Route::when('admins/wilayahcuprimer*', 'wilayahcuprimer');

Route::group(array('prefix' => 'admins','before' => 'auth'), function(){

    Route::resource('artikel','AdminArtikelController',array('except' => array('show')));
    Route::get('artikel/index_kategori/{id}',array(
        'as' => 'admins.artikel.index_kategori',
        'uses' => 'AdminArtikelController@index_kategori'
    ));
    Route::post('artikel/update_kategori',array(
        'as' => 'admins.artikel.update_kategori',
        'uses' => 'AdminArtikelController@update_kategori'
    ));
    Route::post('artikel/update_status',array(
        'as' => 'admins.artikel.update_status',
        'uses' => 'AdminArtikelController@update_status'
    ));
    Route::post('artikel/update_pilihan',array(
        'as' => 'admins.artikel.update_pilihan',
        'uses' => 'AdminArtikelController@update_pilihan'
    ));

    Route::resource('cuprimer','AdminCuprimerController',array('except' => array('show')));
    Route::get('cuprimer/index_wilayah/{id}',array(
        'as' => 'admins.cuprimer.index_wilayah',
        'uses' => 'AdminCuprimerController@index_wilayah'
    ));
    Route::post('cuprimer/update_wilayah',array(
        'as' => 'admins.cuprimer.update_wilayah',
        'uses' => 'AdminCuprimerController@update_wilayah'
    ));
    Route::post('cuprimer/update_berdiri',array(
        'as' => 'admins.cuprimer.update_berdiri',
        'uses' => 'AdminCuprimerController@update_berdiri'
    ));
    Route::post('cuprimer/update_bergabung',array(
        'as' => 'admins.cuprimer.update_bergabung',
        'uses' => 'AdminCuprimerController@update_bergabung'
    ));

    Route::resource('staff','AdminStaffController',array('except' => array('show')));
    Route::post('staff/update_jabatan',array(
        'as' => 'admins.staff.update_jabatan',
        'uses' => 'AdminStaffController@update_jabatan'
    ));
    Route::post('staff/update_tingkat',array(
        'as' => 'admins.staff.update_tingkat',
        'uses' => 'AdminStaffController@update_tingkat'
    ));
    Route::post('staff/update_cu',array(
        'as' => 'admins.staff.update_cu',
        'uses' => 'AdminStaffController@update_cu'
    ));

    Route::resource('pengumuman','AdminPengumumanController',array('except' => array('show','create','edit')));
    Route::post('pengumuman/update_urutan',array(
        'as' => 'admins.pengumuman.update_urutan',
        'uses' => 'AdminPengumumanController@update_urutan'
    ));

    Route::resource('admin','AdminAdminController',array('except' => array('show')));
    Route::get('admin/edit_hak_akses/{id}',array(
        'as' => 'admins.admin.edit_hak_akses',
        'uses' => 'AdminAdminController@edit_hak_akses'
    ));
    Route::post('admin/update_hak_akses',array(
        'as' => 'admins.admin.update_hak_akses',
        'uses' => 'AdminAdminController@update_hak_akses'
    ));
    Route::post('admin/update_status',array(
        'as' => 'admins.admin.update_status',
        'uses' => 'AdminAdminController@update_status'
    ));

    Route::resource('kegiatan','AdminKegiatanController',array('except' => array('show')));
    Route::post('kegiatan/update_mulai',array(
        'as' => 'admins.kegiatan.update_mulai',
        'uses' => 'AdminKegiatanController@update_mulai'
    ));
    Route::post('kegiatan/update_selesai',array(
        'as' => 'admins.kegiatan.update_selesai',
        'uses' => 'AdminKegiatanController@update_selesai'
    ));

    Route::get('statistik',array('as' => 'statistik', function()
    {
        $statistiks = DB::table('stat_pengunjung')
                        ->orderBy('tanggal', 'desc')
                        ->paginate(20);

        return View::make('admins.statistik',compact('statistiks'));
    }));

    Route::resource('pelayanan','AdminPelayananController',array('except' => array('show')));

    Route::resource('download','AdminDownloadController',array('except' => array('show')));
    Route::resource('kantorpelayanan','AdminKantorPelayananController',array('except' => array('show')));
    Route::resource('kategoriartikel','AdminKategoriArtikelController',array('except' => array('show','create','edit')));
    Route::resource('wilayahcuprimer','AdminWilayahCuprimerController',array('except' => array('show','create','edit')));
    Route::resource('infogerakan','AdminInfoGerakanController',array('only' => array('edit','update')));
    Route::resource('saran','AdminSaranController',array('except' => array('show','create','edit')));

});

Route::group(array('before' => 'auth'), function()
{
    \Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    \Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
});
\Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');


/*
Route::get('/start', function() {
    $owner = new Role;
    $owner->name = 'abcd ';
    $owner->save();

    return 'Woohoo!';
});

Route::get('/start', function()
{
    $permision = new Permission;
    $permision->name = 'download';
    $permision->display_name = 'Akses Download';
    $permision->save();

    return 'Woohoo!';
});

Route::get('/test', function()
{
    $now = Date::now()->format('Y-m-d');
    DB::table('kegiatan')
        ->where('tanggal2','<',$now)
        ->update(array('status' => 1));

    return 'lalalalaa';
});

Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});


Route::get('/start', function()
{
    $admin = new Role();
    $admin->name = 'admin';
    $admin->save();

    $user = Admin::where('username','=','t0n1zz')->first();

    $user->attachRole( $admin ); // Parameter can be an Role object, array or id.

    $user->roles()->attach( $master->id ); // id only

    $aksesartikel = new Permission;
    $aksesartikel->name = 'artikel';
    $aksesartikel->display_name = 'Akses Artikel';
    $aksesartikel->save();

    $admin->perms()->sync(array($aksesartikel->id));

    echo '<pre>';
    echo var_dump($data2); // <---- or toJson()
    echo '</pre>';
    return 'Woohoo!';
});
Route::get('/start', function()
{
    $admin = Role::where('name','=','admin')->get()->first();

    $akses = Permission::where('name','=','admin')->get()->first();

    $admin->attachPermission($akses);

    return 'Woohoo!';

});
Route::get('/start', function()
{
    $admin = Role::where('name','=','admin')->get()->first();

    $akses = Permission::where('name','=','admin')->get()->first();

    $admin->detachPermission($akses);

    return 'Woohoo!';

});
Route::get('/start', function()
{
    $admin = Role::where('name','=','test3')->first();

    //$admin->perms()->detach();
    //Role::destroy($admin->id);

    return 'Woohoo!';

});
*///

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
