@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Pengurus Puskopdit BKCU Kalimantan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
@include('_layouts.event')
<!--pengurus-->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab1" data-toggle="tab">Periode 2015 - 2017</a></li>
                        <li><a href="#tab2" data-toggle="tab">Periode 2012 - 2014</a></li>
                    </ul>
                </div>
                <div class="tab-content product-detail-info">
                    <div class="tab-pane active" id="tab1">
                        <?php $i=0; ?>
                        @foreach($penguruses2 as $pengurus)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengurus->gambar) && is_file("images_staff/{$pengurus->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengurus->gambar, $pengurus->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    @if($pengurus->kelamin == "Wanita")
                                                        {{ HTML::image('images/no_image_woman.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @else
                                                        {{ HTML::image('images/no_image_man.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @endif
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
                                    @if($i % 4 == 0 || $i == $penguruses2->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane" id="tab2">
                        <?php $i=0; ?>
                        @foreach($penguruses1 as $pengurus)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengurus->gambar) && is_file("images_staff/{$pengurus->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengurus->gambar, $pengurus->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    @if($pengurus->kelamin == "Wanita")
                                                        {{ HTML::image('images/no_image_woman.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @else
                                                        {{ HTML::image('images/no_image_man.jpg', $pengurus->name, array(
                                                           'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                    @endif
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
                                    @if($i % 4 == 0 || $i == $penguruses1->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/pengurus-->
@stop