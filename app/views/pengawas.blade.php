@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Pengawas Puskopdit BKCU Kalimantan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<!--pengawas-->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab3" data-toggle="tab">Periode 2015 - 2017</a></li>
                        <li><a href="#tab4" data-toggle="tab">Periode 2012 - 2014</a></li>
                    </ul>
                </div>
                <div class="tab-content product-detail-info">
                    <div class="tab-pane active" id="tab3">
                        <?php $i=0; ?>
                        @foreach($pengawases2 as $pengawas)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengawas->gambar) && is_file("images_staff/{$pengawas->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengawas->gambar, $pengawas->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    {{ HTML::image('images/no_image.jpg', $pengawas->name, array(
                                                       'class' => 'img-responsive img-rounded','width' => '100%')) }}
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
                                    @if($i % 4 == 0 || $i == $pengawases2->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="tab-pane active" id="tab4">
                        <?php $i=0; ?>
                        @foreach($pengawases1 as $pengawas)
                            @if($i % 4 == 0 || $i == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-3 col-sm-6">
                                        <div class="team-member shadow">
                                            <div class="team-member-image">
                                                @if(!empty($pengawas->gambar) && is_file("images_staff/{$pengawas->gambar}"))
                                                    {{ HTML::image('images_staff/'.$pengawas->gambar, $pengawas->name, array(
                                                        'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                                @else
                                                    {{ HTML::image('images/no_image.jpg', $pengawas->name, array(
                                                       'class' => 'img-responsive img-rounded','width' => '100%')) }}
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
                                    @if($i % 4 == 0 || $i == $pengawases1->count())
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/pengawas-->
@stop