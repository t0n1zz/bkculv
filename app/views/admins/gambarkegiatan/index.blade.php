<?php $title = "Kelola Gambar Kegiatan"; ?>
@extends('admins._layouts.layout')

@section('content')
<!-- header -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><span class="fa fa-archive"></span> {{$title}}</h1>
    </div>
</div>
<!-- /header -->
<div class="row">
    <div class="col-lg-12 ">
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
        <div class="panel-heading tooltip-demo">
            <a type="button" data-toggle="tooltip" data-placement="top"
                title="Tekan untuk menambah gambar kegiatan baru"
                class="btn btn-default" href="{{ route('admins.gambarkegiatan.create') }}"><i class="fa fa-plus"></i> Tambah Gambar Kegiatan</a>
        </div>
            <div class="panel-body tooltip-demo">
            @foreach($gambarkegiatans as $gambarkegiatan)
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if(!empty($gambarkegiatan->name))
                                <a href="{{route('admins.gambarkegiatan.edit', array($gambarkegiatan->id))}}" data-toggle="tooltip" data-placement="top"
                                   title="Tekan untuk mengubah nama gambar kegiatan ini" name="{{ $gambarkegiatan->id }}"
                                   ><b>{{ $gambarkegiatan->name }}</b></a>
                            @else
                                <a href="{{route('admins.gambarkegiatan.edit', array($gambarkegiatan->id))}}" data-toggle="tooltip" data-placement="top"
                                   title="Tekan untuk mengubah nama gambar kegiatan ini" name="{{ $gambarkegiatan->id }}"
                                   ><b>-</b></a>
                            @endif
                        </div>
                        <div class="panel-body">
                            @if(!empty($gambarkegiatan->gambar) && is_file("images_kegiatan/{$gambarkegiatan->gambar}"))
                                <a href="{{route('admins.gambarkegiatan.edit', array($gambarkegiatan->id))}}">{{ HTML::image('images_kegiatan/'.$gambarkegiatan->gambar, 'a picture', array('class' => 'img-responsive',
                                'id' => 'tampilgambar')) }}</a>
                            @else
                                <a href="{{route('admins.gambarkegiatan.edit', array($gambarkegiatan->id))}}">{{ HTML::image('images/no_image.jpg', 'a picture', array('class' => 'img-responsive',
                                'id' => 'tampilgambar')) }}</a>
                            @endif
                            <br />
                            @if(!empty($gambarkegiatan->id))
                                <td><button class="btn btn-default modal2 pull-right"
                                    name="{{ $gambarkegiatan->id }}"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Tekan untuk menghapus gambar kegiatan ini" ><span
                                    class="glyphicon glyphicon-trash"></span></button></td>
                            @else
                                <td><button class="btn btn-default modal2 pull-right"
                                    name="{{ $gambarkegiatan->id }}"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Tekan untuk menghapus gambar kegiatan ini" disabled><span
                                    class="glyphicon glyphicon-trash"></span></button></td>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- pagination -->
            <div class="col-md-12 col-sm-12 pagination-wrapper">
                @if(!empty($key))
                    {{ $gambarkegiatans->appends(array('q' => $key))->links() }}
                @else
                    {{ $gambarkegiatans->links() }}
                @endif
            </div>
            <!-- /pagination -->
            </div>
    </div>
</div>

<!-- Hapus -->
<div class="modal fade" id="modal2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   {{ Form::open(array('route' => array('admins.gambarkegiatan.destroy'), 'method' => 'delete')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Hapus Gambar Kegiatan</h4>
        </div>
        <div class="modal-body">
          <strong style="font-size: 16px">Menghapus gambar kegiatan ini?</strong>
          <input type="text" name="id" value="" id="modal2id" hidden>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="modalbutton"><i class="fa fa-check"></i> Ok</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
   {{ Form::close() }}
</div>
<!-- /Hapus -->
@stop