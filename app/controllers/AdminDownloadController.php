<?php

class AdminDownloadController extends \BaseController {

    public function index()
    {
        $downloads = Download::all();
        return View::make('admins.download.index', compact('downloads'));
    }

    public function create()
    {
        return View::make('admins.download.create');
    }


    public function store()
    {
        if(Input::get('simpan') || Input::get('simpan2')){
            $validator = Validator::make($data = Input::all(), Download::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $download = new Download();
            $extension = Input::file('upload')->getClientOriginalExtension();
            $name = Input::get('name');
            $string = str_random(20);
            $filename = Date::now()->format('d_m_Y_H_i_s_') . preg_replace('/\s+/', '', $string) . "." . $extension;
            $destinationPath = public_path() . "/files/";

            if (Input::file('upload')->move($destinationPath, $filename)){
                $download->name = $name;
                $download->filename = $filename;
                $download->ekstensi = $extension;
                if ($download->save()) {
                    if (Input::Get('simpan2'))
                        return Redirect::route('admins.download.create')->with('message', 'File <b><i>' . $name . '</i></b> telah berhasil ditambah.');
                    else
                        return Redirect::route('admins.download.index')->with('message', 'File <b><i>' . $name . '</i></b> telah berhasil ditambah.');
                }
            }

            return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penambahan file.');
        }elseif(Input::get('batal')){
            return Redirect::route('admins.download.index');
        }
    }

    public function edit($id)
    {
        $download = Download::find($id);

        return View::make('admins.download.edit', compact('download'));
    }

    public function update()
    {
        $id = Input::get('id');
        //validasi
        $validator = Validator::make($data = Input::all(), Download::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $download = Download::findOrFail($id);

        //simpan
        if($download->update($data))
            return Redirect::route('admins.download.index')->with('message', 'Nama file telah berhasil diubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan file.');

    }


    public function destroy()
    {
        $id = Input::get('id');
        $download = Download::where('id','=',$id)->first();

        $destinationPath = public_path() . "/files/";
        $filename = $destinationPath . $download->filename;

        if(File::delete($filename)){
            if(Download::destroy($id))
                return Redirect::route('admins.download.index')->with('message', 'File telah berhasil di hapus.');
        }

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam penghapusan informasi kegiatan.');
    }
}