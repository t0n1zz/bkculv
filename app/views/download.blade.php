@extends('_layouts.layout')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Download</h1>
            </div>
        </div>
    </div>
</div>
<!-- Page Title -->
<div class="section">
    <div class="container">
        <div class="row">
        @if($downloads->isEmpty())
            <div class="col-md-12 col-sm-12">
                <div class="blog-post shadow">
                    <div class="post-summary">
                        <h3>Belum terdapat file apapun untuk di download</h3>
                    </div>
                </div>
            </div>
        @else
            @foreach($downloads as $download)
                <div class="col-md-3 col-sm-6">
                    <div class="service-wrapper shadow">
                        @if($download->ekstensi == "doc" || $download->ekstensi == "docx" ||
                            $download->ekstensi == "docm" || $download->ekstensi == "dotx" ||
                            $download->ekstensi == "dotm" || $download->ekstensi == "dot")
                            <i class="fa fa-fw fa-5x fa-file-word-o"></i>
                            <h3>Office Word</h3>
                        @elseif($download->ekstensi == "xls" || $download->ekstensi == "xlsx" ||
                                $download->ekstensi == "xlsm" || $download->ekstensi == "xlsb" ||
                                $download->ekstensi == "xltx" || $download->ekstensi == "xltm"||
                                $download->ekstensi == "xlt" )
                            <i class="fa fa-fw fa-5x fa-file-excel-o"></i>
                            <h3>Office Excel</h3>
                        @elseif($download->ekstensi == "pptx" || $download->ekstensi == "ppt" ||
                                $download->ekstensi == "pptm" || $download->ekstensi == "potx" ||
                                $download->ekstensi == "pot" || $download->ekstensi == "potm" ||
                                $download->ekstensi == "ppsx" || $download->ekstensi == "ppsm" ||
                                $download->ekstensi == "pps")
                            <i class="fa fa-fw fa-5x fa-file-powerpoint-o"></i>
                            <h3>Office Powerpoint</h3>
                        @elseif($download->ekstensi == "pdf")
                            <i class="fa fa-fw fa-5x fa-file-pdf-o"></i>
                            <h3>PDF</h3>
                        @elseif($download->ekstensi == "jpg" || $download->ekstensi == "png" ||
                                $download->ekstensi == "jpeg" || $download->ekstensi == "gif" ||
                                $download->ekstensi == "bmp" || $download->ekstensi == "tif")
                            <i class="fa fa-fw fa-5x fa-file-picture-o"></i>
                            <h3>Gambar</h3>
                        @else
                            <i class="fa fa-fw fa-5x fa-file-o"></i>
                            <h3>Lain-lain</h3>
                        @endif
                        <hr/>
                        <p> <b>{{$download->name}}</b></p>
                        <a class="btn" href="{{ route('file',array($download->filename)) }}" ><i class="fa fa-download"></i> Download</a>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
@stop