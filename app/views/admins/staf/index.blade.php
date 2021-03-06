<?php
$title = "Kelola Staf";
$kelas = "staf";
$imagepath = "images_staf/";
?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data Staf</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-sitemap"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- /header -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!--content-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <a accesskey="t" class="btn btn-primary" href="{{ route('admins.'.$kelas.'.create') }}">
                <i class="fa fa-plus"></i> <u>T</u>ambah Staff</a>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Nama </th>
                    <th>Jabatan</th>
                    <th>Tingkat</th>
                    <th>Jenis Kelamin</th>
                    <th>CU</th>
                    <th>Gambar</th>
                    <th>No. Telepon</th>
                    <th>No. Handphone</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>E-mail</th>
                    <th>Pendidikan</th>
                    <th>Kota</th>
                    <th>Alamat</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if(!empty($data->name))
                            <td>{{ $data->name}}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->jabatan))
                            <td>{{ $data->jabatan }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tingkat))
                            @if($data->tingkat == 1 )
                                <td>Pengurus</td>
                            @elseif($data->tingkat == 2)
                                <td>Pengawas</td>
                            @elseif($data->tingkat == 3)
                                <td>Manajemen</td>
                            @endif
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->kelamin))
                            <td>{{ $data->kelamin }}</td>
                        @else
                            <td>-</td>
                        @endif


                        @if(!empty($data->cuprimer))
                            <td>{{ $data->cuprimer->name }}</td>
                        @else
                            @if($data->cu == 0)
                                <td>Puskopdit BKCU Kalimantan</td>
                            @else
                                <td>-</td>
                            @endif
                        @endif

                        @if(!empty($data->gambar) && is_file($imagepath.$data->gambar."n.jpg"))
                            <td style="white-space: nowrap"><div class="modalphotos" >
                                {{ HTML::image($imagepath.$staff->gambar.'n.jpg',asset($imagepath.$data->gambar."jpg"),
                                 array('class' => 'img-responsive',
			        	        'id' => 'tampilgambar', 'width' => '50')) }}
                            </div></td>
                        @elseif(!empty($data->gambar) && is_file($imagepath.$data->gambar))
                            <td style="white-space: nowrap"><div class="modalphotos" >
                                    {{ HTML::image($imagepath.$data->gambar,asset($imagepath.$data->gambar),
                                        array('class' => 'img-responsive ',
                                        'id' => 'tampilgambar', 'width' => '50')) }}
                                </div></td>
                        @else
                            @if($data->kelamin == "Wanita")
                                <td>{{ HTML::image('images/no_image_woman.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            @else
                                <td>{{ HTML::image('images/no_image_man.jpg', 'a picture', array('class' => 'img-responsive',
                            'id' => 'tampilgambar', 'width' => '50')) }}</td>
                            @endif
                        @endif

                        @if(!empty($data->telp))
                            <td>{{ $data->telp }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->handphone))
                            <td>{{ $data->handphone }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->agama))
                            <td>{{ $data->agama }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->status))
                            <td>{{ $data->status }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->email))
                            <td>{{ $data->email }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->pendidikan))
                            <td>{{ $data->pendidikan }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->kota))
                            <td>{{ $data->kota }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->alamat))
                            <?php $newarr = explode("\n",$data->alamat); ?>
                            <td>@foreach($newarr as $str)
                                    <p>{{ $str }}</p>
                                @endforeach
                            </td>
                        @else
                            <td>-</td>
                        @endif


                        <td><a class="btn btn-primary" href="{{route('admins.'.$kelas.'.edit', array($data->id))}}">
                            <i class="fa fa-pencil"></i></a></td>

                        <td><button class="btn btn-danger modal1" name="{{ $data->id }}">
                                <i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Staf</h4>
            </div>
            <div class="modal-body">
                <strong style="font-size: 16px">Menghapus staf ini?</strong>
                <input type="text" name="id" value="" id="modal1id" hidden>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="modalbutton"><i class="fa fa-check"></i> Iya</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop