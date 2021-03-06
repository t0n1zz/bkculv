<?php
$kelas ='admin';
?>
<!-- Alert -->
@include('admins._layouts.alert')
<!-- /Alert -->
<!-- content -->
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="form-group">
            <button type="submit" name="simpan" accesskey="s" class="btn btn-primary">
                <i class="fa fa-save"></i> <u>S</u>impan</button>
            <a href="{{ route('admins.'.$kelas.'.index') }}" name="batal" accesskey="b" class="btn btn-danger">
                <i class="fa fa-times"></i> <u>B</u>atal</a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!--username-->
            <div class="col-lg-6">
                <h4>Username</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    @if(!empty($data))
                        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan username',
                            'autocomplete'=>'off','readonly'))}}
                    @else
                        {{ Form::text('username',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan username',
                            'autocomplete'=>'off'))}}
                    @endif
                    {{ $errors->first('username', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            <!--/username-->
            <!--name-->
            <div class="col-lg-6">
                <h4>Nama</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::text('name',null,array('class' => 'form-control', 'placeholder' => 'Silahkan masukkan nama',
                        'autocomplete'=>'off'))}}
                    {{ $errors->first('username', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            <!--/name-->
            <div class="col-sm-12">
                <div class="form-group">
                    <h4>Tipe</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" onChange="changeFuncUser(value);" name="tipe">
                            <option value="" selected disabled>Silahkan pilih tipe user</option>
                            <option value="1"
                                @if($data->cu == 0)
                                    {{ "selected" }}
                                @endif
                                    >BKCU</option>
                            <option value="2"
                                @if($data->cu > 0)
                                    {{ "selected" }}
                                @endif
                                    >CU Primer</option>
                        </select>
                    </div>
                </div>
            </div>
            @if(empty($data))
            <!--password 1-->
            <div class="col-lg-6">
                <h4>Password</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::password('password',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin'))}}
                    {{ $errors->first('password', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            <br/>
            <!--/password 1-->
            <!--password 2-->
            <div class="col-lg-6">
                <h4>Konfirmasi Password</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    {{ Form::password('password2',array('class' => 'form-control','placeholder' => 'Silahkan masukkan password admin sekali lagi'))}}
                    {{ $errors->first('password2', '<p class="text-warning">:message</p>') }}
                </div>
            </div>
            <!--/password 2-->
            @endif
            @if($data->cu == 0)
                <div class="col-lg-12" id="pilihan2" style="display:inline;">
            @else
                <div class="col-lg-12" id="pilihan2" style="display:none;">
            @endif
                <h4>Hak Akses</h4>
                @include('admins.'.$kelas.'.hak_akses')
            </div>

            @if($data->cu > 0)
                <div class="col-lg-12" id="pilihan" style="display:inline;">
            @else
                <div class="col-lg-12" id="pilihan" style="display:none;">
            @endif
                <div class="form-group">
                    <h4>CU</h4>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-list"></i></div>
                        <select class="form-control" name="partner">
                            <option value="" selected disabled>Silahkan pilih CU</option>
                            @foreach($datas2 as $data2)
                                <option value="{{ $data2->id }}"
                                @if(!empty($data))
                                    @if($data->cu == $data->id)
                                        {{ "selected" }}
                                            @endif
                                        @endif
                                        >{{ $data2->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>