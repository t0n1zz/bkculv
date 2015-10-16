<?php

class AdminSaranController extends \BaseController {

    public function index()
    {
        $sarans = Saran::orderBy('created_at','desc')->get();;
        return View::make('admins.saran.index', compact('sarans'));
    }

    public function destroy()
    {
        $id = Input::get('id');

        if(Saran::destroy($id)) {
            return Redirect::route('admins.saran.index')->with('message', 'Saran atau kritik telah berhasil di hapus.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan saram atau kritik.');
    }
}