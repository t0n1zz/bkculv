<?php
$title = "Kelola CU";
$kelas = 'cuprimer';
?>

@extends('admins._layouts.layout')

@section('content')
        <!-- header -->
<section class="content-header">
    <h1>
        <i class="fa fa-archive"></i> {{ $title }}
        <small>Mengelola Data CU Primer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('admins')  }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-building"></i> {{ $title }}</li>
    </ol>
</section>
<!-- /header -->
<!-- Main content -->
<section class="content">
    <!-- Alert -->
    @include('admins._layouts.alert')
    <!-- /Alert -->
    <!-- content -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <a type="button" accesskey="t" class="btn btn-primary"
               href="{{ route('admins.'.$kelas.'.create') }}"><i class="fa fa-fw fa-plus"></i> <u>T</u>ambah CU</a>
            @if($is_wilayah)
                <a type="button"  accesskey="e" class="btn btn-sucess"
                   href="{{ route('admins.'.$kelas.'.index') }}"><i class="fa fa-fw fa-refresh"></i> S<u>e</u>mua CU</a>
            @endif
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>No. BA</th>
                    <th>Nama </th>
                    <th>Wilayah</th>
                    <th>Tanggal Berdiri</th>
                    <th>Tanggal Bergabung</th>
                    <th>TP</th>
                    <th>Staf</th>
                    <th>Aplikasi</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr>
                        @if(!empty($data->no_ba))
                            <td>{{ $data->no_ba }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->name))
                            <td>{{ $data->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->wilayahcuprimer->name))
                            <td>{{ $data->wilayahcuprimer->name }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->ultah))
                            <?php $date = new Date($data->ultah); ?>
                            <td> {{  $date->format('n/d/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->bergabung))
                            <?php $date2 = new Date($data->bergabung); ?>
                            <td><i hidden="true">{{$data->bergabung}}</i> {{  $date2->format('d/n/Y') }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->tp))
                            <td>{{ $data->tp }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->staf))
                            <td>{{ $data->staf }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->app))
                            <td>{{ $data->app }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->email))
                            <td>{{ $data->email }}</td>
                        @else
                            <td>-</td>
                        @endif

                        @if(!empty($data->website))
                            <td><a class="btn btn-warning" href="http://{{$data->website}}" class="facebook" target="_blank">
                                    <i class="fa fa-globe"></i> {{ $data->website }} </a></td>
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
    <!-- content -->
</section>

<!-- modal -->
<!-- Hapus -->
<div class="modal fade" id="modal1show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::model($datas, array('route' => array('admins.'.$kelas.'.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus CU</h4>
            </div>
            <div class="modal-body">
                <strong style="font-size: 16px">Menghapus CU ini?</strong>
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
<!-- /.modal -->

@stop