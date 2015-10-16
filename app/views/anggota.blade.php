@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Anggota Puskopdit BKCU Kalimantan</h1>
                </div>
            </div>
        </div>
    </div>
<!-- /Page Title -->
<div class="section">
    <div class="container">
        <div class="row">
            @foreach($jejarings as $jejaring)
            <div class="col-sm-3">
                <ul class="list-unstyled">
                    <li>
                        <a class="smoothscroll btn btn-default btn-block btn-lg" href="#wilayah{{$jejaring->id}}"
                           style="font-size: medium"><b>{{ $jejaring->name }} <span class="badge">{{ $jejaring->cuprimer->count() }}</span></b></a>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="eshop-section section">
    <div class="container">
    @foreach($jejarings as $jejaring)
    <div class="row">
        <h2 id="wilayah{{$jejaring->id}}">{{$jejaring->name}}</h2>
        <?php $i = 0; ?>
        @foreach($jejaring->cuprimer as $cuprimer)
        <div class="col-sm-3">
            <ul class="list-unstyled">
                <li>
                    <?php
                    $date = new Date($cuprimer->ultah);
                    $date2 = Date::now()->format('d-m');
                    ?>
                    @if($date->format('d-m') == $date2)
                        <div class="well shadow" style="background: wheat;">
                            <a class="smoothscroll" href="{{ route('cudetail',array($cuprimer->id)) }}"
                               style="font-size: large"><b><small><i class="fa fa-star-o"></i> Anniversary <i class="fa fa-star-o"></i></small><br/>{{ $cuprimer->name }} <i class="fa fa-arrow-circle-right"></i></b></a>
                        </div>
                    @else
                        <div class="well shadow" >
                            <a class="smoothscroll" href="{{ route('cudetail',array($cuprimer->id)) }}"
                               style="font-size: large"><b>{{ $cuprimer->name }} <i class="fa fa-arrow-circle-right"></i></b></a>
                        </div>
                    @endif
                </li>
            </ul>
        </div>
        @endforeach
    </div><br/>
    @endforeach
    </div>
</div>

@stop