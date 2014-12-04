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
	    data-placement='top' title ='Menyimpan informasi admin' value="simpan"><i class="fa fa-save"></i> Simpan</button>

	<button type="submit" name="batal" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi admin dan kembali ke halaman kelola admin' value="batal"><i class="fa fa-times"></i> Batal</button>
	<!--<a href="{{ URL::previous() }}" class="btn btn-default">Batal</a>-->
</div>
<!--/button-->
<div class="panel-body">
    <!--username-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Username') }}
        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan username'))}}
        {{ $errors->first('username', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/username-->
    <!--name-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama admin'))}}
        {{ $errors->first('name', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/name-->
    <hr/>
    <!--password lama-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Password Lama') }}
        {{ Form::password('oldpassword',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password lama admin ini'))}}
        {{ $errors->first('oldpassword', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/password lama-->
    <!--password baru-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Password Baru') }}
        {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password baru admin ini'))}}
        {{ $errors->first('password', '<p class="text-warning"><i>:message</i></p>') }}
    </div>
    </div>
    <!--/password baru-->
</div>
</div>