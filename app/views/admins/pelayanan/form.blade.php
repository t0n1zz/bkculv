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
	<button type="submit" name="simpan" class="btn btn-primary" data-toggle ='tooltip'
	    data-placement='top' title ='Menyimpan informasi pelayanan' value="simpan"><i class="fa fa-save"></i> Simpan</button>
    <button type="submit" name="simpan2" class="btn btn-primary" data-toggle ='tooltip'
    	    data-placement='top' title ='Menyimpan informasi pelayanan dan memulai menambah pelayanan baru' value="simpan"><i class="fa fa-save fa-fw"></i><i class="fa fa-plus"></i> Simpan dan buat baru</button>
	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi pelayanan dan kembali ke halaman kelola pelayanan' value="batal"><i class="fa fa-times"></i> Batal</button>
</div>
<!--/button-->
<div class="panel-body">
    <!--nama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama Pelayanan') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama pelayanan'))}}
        {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
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
                {{ Form::file('gambar', array('onChange' => 'readURL(this)')) }}
             </div>
        </div>
        {{ $errors->first('gambar', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/gambar-->
    <!--content-->
    <div class="col-lg-12">
        {{ Form::label('Deskripsi pelayanan') }}
        {{ Form::textarea('content',null,array('style' => 'height:300px')) }}
        {{ $errors->first('content', '<p class="text-warning"><i>:message</i></p>') }}
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