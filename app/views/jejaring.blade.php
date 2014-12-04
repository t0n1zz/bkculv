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

            <div class="col-sm-6 col-md-3" id="cu{{$cuprimer->id}}">
                <div class="blog-post">
                    <div class="post-title">
                        <h3>{{$cuprimer->name}}</h3>
                    </div>
                    <br />
                    <div class="post-summary">
                        <div class="actions">
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