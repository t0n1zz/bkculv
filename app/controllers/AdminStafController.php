<?php

class AdminStafController extends \BaseController{

    protected $kelaspath = 'staf';
    protected $imagepath = 'images_staf/';

    public function index()
    {
        try{
            $datas = Staf::with('cuprimer')->orderBy('cu','asc')->get();;
            $datas2 = Cuprimer::all();

            return View::make('admins.'.$this->kelaspath.'.index', compact('datas','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function create()
    {
        try{
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return View::make('admins.'.$this->kelaspath.'.create',compact('datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function store()
    {
        try{
            $validator = Validator::make($data = Input::all(), Staff::$rules);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $name = Input::get('name');

            $kelas = new Staf();
            $data2 = $this->input_data($kelas,$data);

            Staff::create($data2);

            if(Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' .$name. '</i></b> Telah berhasil ditambah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $data = Staf::find($id);
            $datas2 = Cuprimer::orderBy('name','asc')->get();;
            return View::make('admins.'.$this->kelaspath.'.edit', compact('data','datas2'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function update($id)
    {
        try{
            $kelas = Staf::findOrFail($id);

            $validator = Validator::make($data = Input::all(), Staff::$rules);
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $name = Input::get('name');
            $data2 = $this->input_data($kelas,$data,$name);

            $kelas->update($data2);

            //simpan
            if (Input::Get('simpan2'))
                return Redirect::route('admins.'.$this->kelaspath.'.create')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
            else
                return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff <b><i>' . $name . '</i></b> Telah berhasil diubah.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function input_data($kelas,$data){

        $name = str_limit(preg_replace('/\s+/', '',Input::get('name')),10);
        //gambar
        try {
            $img = Input::file('gambar');
            if (!is_null($img)) {
                $formatedname = $name.str_random(3).date('Y-m-d');
                $filename = $formatedname.".jpg";
                $filename2 = $formatedname."n.jpg";

                if ($this->save_image($img, $kelas, $filename,$filename2))
                    array_set($data,'gambar',$filename);
                else
                    return false;
            }else{
                $filename = $kelas->gambar;
                array_set($data,'gambar',$filename);
            }
        } catch (Exception $e) {
            $this->status = $e->getMessage();
        }

        return $data;
    }

    public function destroy()
    {
        try{
            $id = Input::get('id');
            $kelas = Staf::findOrFail($id);
            $path = public_path($this->imagepath);


            File::delete($path . $kelas->gambar);
            File::delete($path. $kelas->gambar.".jpg");
            File::delete($path. $kelas->gambar."n.jpg");

            Staff::destroy($id);

            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'Staff Telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }


    function save_image($img,$kelas,$filename,$filename2)
    {
        list($width, $height) = getimagesize($img);

        $path = public_path($this->imagepath);

        File::delete($path . $kelas->gambar);
        File::delete($path . $kelas->gambar .".jpg");
        File::delete($path . $kelas->gambar ."n.jpg");

        if($width > 720){
            Image::make($img->getRealPath())->resize(720, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path . $filename);
        }else{
            Image::make($img->getRealPath())->save($path . $filename);
        }

        Image::make($img->getRealPath())->fit(200,150)->save($path . $filename2);
    }
}