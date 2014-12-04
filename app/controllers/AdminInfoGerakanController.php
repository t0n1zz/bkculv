<?php

class AdminInfoGerakanController extends \BaseController{

    /**
     * Show the form for editing the specified artikel.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $infogerakan = InfoGerakan::find($id);

        return View::make('admins.infogerakan.edit', compact('infogerakan'));
    }

    public function update($id)
    {
        //validasi
        $validator = Validator::make($data = Input::all(), InfoGerakan::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $infogerakan = InfoGerakan::findOrFail($id);
        $timestamp = strtotime(Input::get('tanggal'));
        $tanggal = date('Y-m-d',$timestamp);

        $infogerakan->tanggal = $tanggal;
        $infogerakan->jumlah_anggota = Input::get('jumlah_anggota');
        $infogerakan->jumlah_cu = Input::get('jumlah_cu');
        $infogerakan->jumlah_staff_cu = Input::get('jumlah_staff_cu');
        $infogerakan->piutang_beredar = Input::get('piutang_beredar');
        $infogerakan->piutang_lalai_1 = Input::get('piutang_lalai_1');
        $infogerakan->piutang_lalai_2 = Input::get('piutang_lalai_2');
        $infogerakan->piutang_bersih = Input::get('piutang_bersih');
        $infogerakan->asset = Input::get('asset');
        $infogerakan->shu = Input::get('shu');

        //simpan
        if($infogerakan->update())
            return Redirect::route('admins.infogerakan.edit',array(1))->with('message', 'Informasi Gerakan Telah berhasil diubah.');

        return Redirect::back()->withInput()->with('errormessage','Terjadi kesalahan dalam pengubahan kategori artikel.');
    }
}