@extends('_layouts.layout')

@section('content')
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Attribution</h1>
            </div>
        </div>
    </div>
</div>
<img class="img-responsive" src="{{ asset('images/top.png') }}" width="100%"  style="vertical-align: top;margin-top: -10px;margin-bottom: -3%;"/>
<div class="section">
    <div class="container">
        <h2>Many Thanks To</h2>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="https://github.com/dragdropsite/mPurpose" target="_blank">mPurpose</a> - for CSS Template</li>
                    <li><a href="http://www.freepik.com/free-photos-vectors/birthday" target="_blank">Birthday vector designed by Freepik</a> - for images</li>
                    <li><a href="http://www.freepik.com/free-photos-vectors/christmas" target="_blank">Christmas vector designed by Freepik</a> - for images</li>
                    <li><a href="https://www.vectoropenstock.com/vectors/preview/72006/real-estate-selling-process-infographics" target="_blank">Real estate selling process infographics vector</a> - for images</li>
                    <li><a href="https://github.com/kni-labs/rrssb" target="_blank">Ridiculously Responsive Social Sharing Buttons</a> - for custom social sharing buttons</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop