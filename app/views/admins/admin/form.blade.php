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
	    data-placement='top' title ='Menyimpan informasi admin' value="simpan"><i
                class="fa fa-save"></i> <u>S</u>impan</button>

	<a href="{{ route('admins.admin.index') }}" name="batal" accesskey="b" class="btn btn-danger" data-toggle ='tooltip'
	    data-placement='top' title ='Batal menyimpan informasi admin dan kembali ke halaman kelola admin' value="batal"><i
                class="fa fa-times"></i> <u>B</u>atal</a>
	<!--<a href="{{ URL::previous() }}" class="btn btn-default">Batal</a>-->
</div>
<!--/button-->
<div class="panel-body">
    <!--username-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Username') }}
        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan username',
            'autocomplete'=>'off','autofocus'))}}
        {{ $errors->first('username', '<p class="text-warning">:message</p>') }}
    </div>
    </div>
    <!--/username-->
    <!--name-->
    <div class="col-lg-10">
    <div class="form-group">
        {{ Form::label('Nama') }}
        {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama admin',
            'autocomplete'=>'off'))}}
        {{ $errors->first('name', '<p class="text-warning">:message</p>') }}
    </div>
    </div>
    <!--/name-->
    <hr/>
    @if(!empty($admin))
        <!--password lama-->
        <div class="col-lg-10">
        <div class="form-group">
            {{ Form::label('Password Lama') }}
            {{ Form::password('oldpassword',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password lama admin ini',))}}
            {{ $errors->first('oldpassword', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <!--/password lama-->
        <!--password baru-->
        <div class="col-lg-10">
        <div class="form-group">
            {{ Form::label('Password Baru') }}
            {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password baru admin ini'))}}
            {{ $errors->first('password', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <!--/password baru-->
    @else
        <!--password 1-->
        <div class="col-lg-10">
        <div class="form-group">
            {{ Form::label('Password') }}
            {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin'))}}
            {{ $errors->first('password', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <!--/password 1-->
        <!--password 2-->
        <div class="col-lg-10">
        <div class="form-group">
            {{ Form::label('Konfirmasi Password') }}
            {{ Form::password('password2',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin sekali lagi'))}}
            {{ $errors->first('password2', '<p class="text-warning">:message</p>') }}
        </div>
        </div>
        <!--/password 2-->
    @endif
    @if(empty($admin))
        <div class="col-lg-12">
            {{ Form::label('Hak Akses') }}
            @include('admins.admin.hak_akses')
        </div>
    @endif
</div>
</div>