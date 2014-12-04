<?php $title="Tambah Pelayanan"; ?>
@extends('admins._layouts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-plus"></i> {{$title}}</h1>
    </div>
</div>
<div class="row">
    <div class=" col-lg-12">

	{{ Form::open(array('route' => array('admins.pelayanan.store'), 'files' => true)) }}
		@include('admins.pelayanan.form')
	{{ Form::close() }}

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
      var roxyFileman = '../../../public/js/tinymce/plugins/fileman/index.html?integration=tinymce4';
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
@stop