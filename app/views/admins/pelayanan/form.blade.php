@if($errors->has())
    <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <p>Oops terjadi kesalahan!</p>
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
	    data-placement='top' title ='Menyimpan informasi pelayanan' value="simpan"><i
                class="fa fa-save"></i> <u>S</u>impan</button>
    <button type="submit" name="simpan2" accesskey="m" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi pelayanan dan memulai menambah pelayanan baru'
            value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Si<u>m</u>pan dan buat baru</button>
	<a href="{{ route('admins.pelayanan.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi pelayanan dan kembali ke halaman kelola pelayanan'
        value="batal"><i class="fa fa-times"></i> <u>B</u>atal</a>
</div>
<!--/button-->
<div class="panel-body">
    <!--nama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama Pelayanan') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama pelayanan',
            'required','min-length' => '5','data-error' => 'Nama pelayanan wajib diisi dan minimal 5 karakter','autocomplete'=>'off','autofocus'))}}
        <div class="help-block with-errors"></div>
        {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
    </div>
    </div>
    <!--/nama-->
    <!--gambar-->
    <div class="col-lg-5">
    <div>
        {{ Form::label('Upload Gambar') }}
        <div class="thumbnail" >
        @if(!empty($pelayanan->gambar))
        	{{ HTML::image('images_artikel/'.$pelayanan->gambar, 'a picture', array('class' => 'img-responsive', 'id' => 'tampilgambar')) }}
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
    <!--/gambar-->
    <!--content-->
    <div class="col-lg-12">
        {{ Form::label('Deskripsi pelayanan') }}
        {{ Form::textarea('content',null,array('style' => 'height:300px')) }}
        {{ $errors->first('content', '<p class="text-warning">:message</p>') }}
    </div>
    <!--/content-->
</div>
</div>
{{ HTML::script('plugins/ckeditor/ckeditor.js') }}
<script type="text/javascript">
    var roxyFileman = '{{ asset('plugins/fileman/index.html')  }}';

    CKEDITOR.replace( 'content',{
        filebrowserBrowseUrl:roxyFileman,
        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
        removeDialogTabs: 'link:upload;image:upload'});

</script>