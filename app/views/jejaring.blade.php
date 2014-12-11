@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Jejaring</h1>
                </div>
            </div>
        </div>
    </div>
<!-- /Page Title -->
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
    <div class="container">
        @foreach($jejarings as $jejaring)
        <div class="col-sm-2">
            <ul class="sitemap">
                <li><a href="#wilayah{{$jejaring->id}}">{{ $jejaring->name }}</a>
                    <ul>
                        @foreach($jejaring->cuprimer as $cuprimer)
                            <li><a href="#cu{{$cuprimer->id}}">{{ $cuprimer->name }}</a> </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</div>

<div class="eshop-section section">
    <div class="container">
    @foreach($jejarings as $jejaring)
    <div class="row">
        <h2 id="wilayah{{$jejaring->id}}">{{$jejaring->name}}</h2>
        <?php $i = 0; ?>
        @foreach($jejaring->cuprimer as $cuprimer)
            @if($i % 4 == 0 || $i == 0)
                <div class="row">
            @endif
            <?php
                $date = new Date($cuprimer->ultah);
                $date2 =  Date::now()->format('d-m');
            ?>
            <div class="col-sm-6 col-md-3" id="cu{{$cuprimer->id}}">
                <div class="blog-post shadow">
                    <div class="post-title">
                        <h3 style="font-size: large">{{$cuprimer->name}}</h3>
                    </div>
                    @if($date->format('d-m') == $date2)
                        <div class="ribbon-wrapper">
                            <div class="price-ribbon ribbon-green">Anniversary</div>
                        </div>
                    @endif
                    <hr style="border:1px solid #D2D2D2;" />
                    <div class="post-summary">
                        <div class="actions">
                            <p><b>Berdiri :</b> {{$date->format('j F Y')}}</p>
                            {{ $cuprimer->content }}
                        </div>
                    </div>
                </div>
            </div>
            <?php $result = $jejaring->cuprimer->count(); ?>
            <?php $i++; ?>
            @if($i % 4 == 0 || $i == $result)
                </div>
            @endif
        @endforeach
    </div><br/>
    @endforeach
    </div>
</div>
@stop