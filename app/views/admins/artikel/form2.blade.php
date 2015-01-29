@if($errors->has())
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span
                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Oops terjadi kesalahan!</strong>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if(Session::has('message'))
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>{{ Session::get('message') }}</p>
    </div>
@endif

@if(Session::has('errormessage'))
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>{{ Session::get('errormessage') }}</p>
    </div>
@endif
<div class="panel panel-default">
    <!--button-->
    <div class="panel-heading tooltip-demo">
        <button type="submit" name="simpan" accesskey="s" class="btn btn-primary" data-toggle ='tooltip'
                data-placement='top' title ='Menyimpan artikel' value="simpan"><i
                    class="fa fa-save"></i> <u>S</u>impan</button>
        <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
                data-placement='top' title ='Menyimpan artikel dan memulai menambah artikel baru ' value="simpan"><i
                    class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
        <a href="{{ route('admins.artikel.index' )}}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
                data-placement='top' title ='Batal menyimpan artikel dan kembali ke halaman kelola artikel (alt+b)' value="batal"><i
                    class="fa fa-times"></i> <u>B</u>atal</a>
        <!--<a href="{{ URL::previous() }}" class="btn btn-default">Batal</a>-->
    </div>
    <!--/button-->
    <div class="panel-body">
        <!--judul-->
        <div class="col-lg-10">
            <div class="form-group">
                {{ Form::label('Judul Artikel') }}
                {{ Form::text('judul',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan judul artikel',
                    'required','min-length' => '5','data-error' => 'Judul wajib diisi dan minimal 5 karakter',
                    'autocomplete'=>'off','autofocus')) }}
                <div class="help-block with-errors"></div>
                {{ $errors->first('judul', '<p class="text-warning">:message</p>') }}
            </div>
        </div>
        <!--/judul-->
        <!--kategori-->
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('Kategori') }}
                <select class="form-control" onChange="changeFunc(value);" name="kategori">
                    <option value="" selected disabled>Silahkan pilih kategori artikel</option>
                    @foreach($kategori_artikel as $kategoriartikel)
                        <option value="{{ $kategoriartikel->id }}"
                        @if(!empty($artikel))
                            @if($artikel->kategori == $kategoriartikel->id)
                                {{ "selected" }}
                                    @endif
                                @endif
                                >{{ $kategoriartikel->name }}</option>
                    @endforeach
                    <option value="tambah" >Tambah Kategori Baru</option>
                </select>
            </div>
        </div>
        <!--/kategori-->
        <!--kategori baru-->
        <div class="col-lg-4"  id="pilihan" style="display:none;">
            <div class="form-group">
                {{ Form::label('Kategori Baru') }}
                {{ Form::text('kategori_baru',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan kategori baru',
                   'autocomplete'=>'off','maxlength' => '50'))}}
            </div>
        </div>
        <!--/kategori baru-->
        <!--status-->
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('Status') }}
                <select class="form-control" name="status">
                    <option value="" selected disabled>Silahkan pilih Status Publikasi Artikel</option>
                    <option value="0"
                        @if(!empty($artikel))
                            @if($artikel->status == 0)
                                {{ "selected" }}
                            @endif
                        @endif
                    >Tidak diterbitkan</option>
                    <option value="1"
                        @if(!empty($artikel))
                            @if($artikel->status == 1)
                                {{ "selected" }}
                            @endif
                        @endif
                    >Terbitkan</option>
                </select>
            </div>
        </div>
        <!--/status-->
        <!--gambar utama-->
        <div class="col-lg-5">
            <div class="form-group">
                {{ Form::label('Tampilkan Gambar Utama') }}
                <div class="input-group">
        <span class="input-group-addon">
        	@if(!empty($artikel->gambar))
                {{ Form::checkbox('gambarutama','1',true,array('id' => 'tampilinputgambar')) }}
            @else
                {{ Form::checkbox('gambarutama','1',false,array('id' => 'tampilinputgambar')) }}
            @endif
        </span>
                    @if(!empty($artikel->gambar))
                        {{ Form::text('null','Iya, gambar akan muncul di list artikel dan view artikel',array('class' =>
                           'form-control', 'id' => 'gambartext' ,'disabled' => 'true'))}}
                    @else
                        {{ Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'gambartext' ,'disabled' => 'true'))}}
                    @endif
                </div>
            </div>
            <div id="inputgambar"
                @if(empty($artikel->gambar))
                    {{ "style='display:none;'" }}
                @endif
            >
                <div class="thumbnail" >
                    @if(!empty($artikel->gambar))
                        {{ HTML::image('images_artikel/'.$artikel->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
                    @else
                        {{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
                    @endif
                    <div class="caption">
                        {{ Form::file('gambar', array('onChange' => 'readURL(this)','accept' => 'image/*')) }}
                    </div>
                </div>
                {{ $errors->first('gambar', '<p class="text-warning">:message</p>') }}
            </div>
        </div>
        <!--/gambar utama-->
        <!--artikel pilihan-->
        <div class="col-lg-5">
            <div class="form-group">
                {{ Form::label('Artikel Pilihan') }}
                <div class="input-group">
        <span class="input-group-addon">
            @if(!empty($artikel->pilihan))
                {{ Form::checkbox('pilihan','1',true,array('id' => 'artikelpilihan')) }}
            @else
                {{ Form::checkbox('pilihan','1',false,array('id' => 'artikelpilihan')) }}
            @endif
        </span>
                    @if(!empty($artikel))
                        @if($artikel->pilihan == 0)
                            {{ Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'artikeltext' ,'disabled' => 'true'))}}
                        @else
                            {{ Form::text('null','Iya, artikel akan muncul di slideshow',array('class' => 'form-control', 'id' => 'artikeltext' ,
                               'disabled' => 'true'))}}
                        @endif
                    @else
                        {{ Form::text('null','Tidak',array('class' => 'form-control', 'id' => 'artikeltext' ,'disabled' => 'true'))}}
                    @endif
                </div>
            </div>
        </div>
        <!--/artikel pilihan-->
        <!--content-->
        <div class="col-lg-12">
            {{ Form::label('Isi Artikel') }}
            {{ Form::textarea('content',null,array('style' => 'height:300px')) }}
            {{ $errors->first('content', '<p class="text-warning">:message</p>') }}
        </div>
        <!--/content-->
    </div>
</div>
{{ HTML::script('js/tinymce/tinymce.min.js') }}
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        skin: 'light',
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons | fontselect fontsizeselect",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ],
        file_browser_callback: RoxyFileBrowser
    });

    function RoxyFileBrowser(field_name, url, type, win) {
        var roxyFileman = '{{ asset('js/tinymce/plugins/fileman/index.html?integration=tinymce4')  }}';
        if (roxyFileman.indexOf("?") < 0) {
            roxyFileman += "?type=" + type;
        }
        else {
            roxyFileman += "&type=" + type;
        }
        roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
        tinyMCE.activeEditor.windowManager.open({
            file: roxyFileman,
            title: 'File Manager',
            width: 800,
            height: 480,
            resizable: "yes",
            plugins: "media",
            inline: "yes",
            close_previous: "no"
        }, {     window: win,     input: field_name    });
        return false;
    }
</script>