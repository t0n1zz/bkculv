@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Manajemen Puskopdit BKCU Kalimantan</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Title -->
<!--manajemen-->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php $i=0; ?>
                @foreach($manajemens as $manajemen)
                    @if($i % 4 == 0 || $i == 0)
                        <div class="row">
                            @endif

                            <div class="col-md-3 col-sm-6">
                                <div class="team-member shadow">
                                    <div class="team-member-image">
                                        @if(!empty($manajemen->gambar) && is_file("images_staff/{$manajemen->gambar}"))
                                            {{ HTML::image('images_staff/'.$manajemen->gambar, $manajemen->name, array(
                                                'class' => 'img-responsive img-rounded','width' => '100%')) }}
                                        @else
                                            {{ HTML::image('images/no_image.jpg', $manajemen->name, array(
                                               'class' => 'img-responsive img-rounded','width' => '100%')) }}
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
</div>
<!--/manajemn-->
@stop