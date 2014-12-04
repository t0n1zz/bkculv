@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tim Puskopdit BKCU Kalimantan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<!--pengurus-->
<div class="section">
    <div class="container">
        <h2>Pengurus</h2>
        <div class="row">
        <?php $i=0; ?>
        @foreach($penguruses as $pengurus)
            @if($i % 4 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="col-md-3 col-sm-6">
                <div class="team-member">
                    <div class="team-member-image">
                        @if(!empty($pengurus->gambar) && is_file("images_staff/{$pengurus->gambar}"))
                            {{ HTML::image('images_staff/'.$pengurus->gambar, $pengurus->name, array(
                                'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @else
                            {{ HTML::image('images/no_image.jpg', $pengurus->name, array(
                               'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @endif
                    </div>
                    <div class="team-member-info">
                        <ul>
                            <li class="team-member-name">{{ $pengurus->name }}</li>
                            <li>{{ $pengurus->jabatan }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $i++; ?>
            @if($i % 4 == 0 || $i == $penguruses->count())
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>
<!--/pengurus-->
<!--pengawas-->
<div class="section">
    <div class="container">
        <h2>Pengawas</h2>
        <div class="row">
        <?php $i=0; ?>
        @foreach($pengawases as $pengawas)
            @if($i % 4 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="col-md-3 col-sm-6">
                <div class="team-member">
                    <div class="team-member-image">
                        @if(!empty($pengawas->gambar) && is_file("images_staff/{$pengawas->gambar}"))
                            {{ HTML::image('images_staff/'.$pengawas->gambar, $pengawas->name, array(
                                'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @else
                            {{ HTML::image('images/no_image.jpg', $pengawas->name, array(
                               'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @endif
                    </div>
                    <div class="team-member-info">
                        <ul>
                            <li class="team-member-name">{{ $pengawas->name }}</li>
                            <li>{{ $pengawas->jabatan }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $i++; ?>
            @if($i % 4 == 0 || $i == $pengawases->count())
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>
<!--/pengawas-->
<!--manajemen-->
<div class="section">
    <div class="container">
        <h2>Manajemen</h2>
        <div class="row">
        <?php $i=0; ?>
        @foreach($manajemens as $manajemen)
            @if($i % 4 == 0 || $i == 0)
                <div class="row">
            @endif

            <div class="col-md-3 col-sm-6">
                <div class="team-member">
                    <div class="team-member-image">
                        @if(!empty($manajemen->gambar) && is_file("images_staff/{$manajemen->gambar}"))
                            {{ HTML::image('images_staff/'.$manajemen->gambar, $manajemen->name, array(
                                'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @else
                            {{ HTML::image('images/no_image.jpg', $manajemen->name, array(
                               'class' => 'img-responsive img-rounded','width' => '444')) }}
                        @endif
                    </div>
                    <div class="team-member-info">
                        <ul>
                            <li class="team-member-name">{{ $manajemen->name }}</li>
                            <li>{{ $manajemen->jabatan }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $i++; ?>
            @if($i % 4 == 0 || $i == $manajemens->count())
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>
<!--/manajemn-->
@stop