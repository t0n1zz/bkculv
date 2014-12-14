<?php
    $navberita = KategoriArtikel::whereNotIn('id',array(1,4,8))->get();
    $infogerakan = InfoGerakan::find(1);
    $pengumumans = Pengumuman::orderBy('urutan','asc')->get();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Puskopdit BKCU Kalimantan</title>
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
        <meta name="description" content="Puskopdit BKCU Kalimantan (awalnya BK3D Kalbar) berdiri pada tanggal 27 November 1988 di Pontianak. Sebagai credit union sekunder, Puskopdit BKCU Kalimantan aktif mempromosikan dan memfasilitasi berdirinya credit union - credit union primer.">
        <meta name="viewport" content="width=device-width">

        @if(!empty($detail_artikel))
            <!-- Facebook Open Graph Meta Tags -->
            <meta property="og:title" content="{{ $detail_artikel->judul }}" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="{{Request::url()}}" />
            <meta property="og:image" content="{{ asset('images_artikel/'.$detail_artikel->gambar) }}" />
            <meta property="og:description" content="{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $detail_artikel->content),200) }}" />
            {{ HTML::style('plugins/social/css/rrssb.css') }}
        @endif

        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/icomoon-social.css') }}
        {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}
        {{ HTML::style('css/main.css') }}
        {{ HTML::script('js/modernizr-2.6.2-respond-1.1.0.min.js') }}
        {{ HTML::style('css/mystyle.css') }}
    </head>
    <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div style="padding-right: 15px;">
        <div class="row">
            <div class="col-sm-12 marquee" style="background: #222;padding-top: 10px;border-bottom: 4px solid #4f8db3;color: white;">
                @foreach($pengumumans as $pengumuman)
                    <b> • {{ $pengumuman->name }} • </b>
                @endforeach
            </div>
        </div>
    </div>


      <!-- Navigation & Logo-->
      @include('_layouts.navigation')

      @yield('content')

      <img class="img-responsive" src="{{ asset('images/footer.png') }}" width="100%"  style="vertical-align: bottom;margin-bottom: -20px;margin-top: -3%;"/>
      @include('_layouts.footer')

      <!-- Javascripts -->

      <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
      {{ HTML::script('js/jquery-1.9.1.min.js') }}
      {{ HTML::script('js/bootstrap.min.js') }}
      {{ HTML::script('js/jquery.fitvids.js') }}
      {{ HTML::script('js/jquery.sequence-min.js') }}
      {{ HTML::script('js/jquery.bxslider.js') }}
      {{ HTML::script('js/main-menu.js') }}
      {{ HTML::script('js/template.js') }}
      {{ HTML::script('js/newsticker/jquery.marquee.min.js') }}
      {{ HTML::style('js/newsticker/li-scroller.css') }}
      <script type="text/javascript">
      $('.marquee').marquee({
        pauseOnHover: false,
        //speed in milliseconds of the marquee
        duration: 20000,
        //gap in pixels between the tickers
        gap: 5,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: 'left',
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true
      });
      </script>
      <script type="text/javascript">
      // smooth scroll to website compoenent id
      $(document).ready(function() {
          $('html, body').hide();

          if (window.location.hash) {
              setTimeout(function() {
                  $('html, body').scrollTop(0).show();
                  $('html, body').animate({
                      scrollTop: $(window.location.hash).offset().top-20
                      }, 1000)
              }, 0);
          }
          else {
              $('html, body').show();
          }
      });
      </script>
      {{ HTML::script('js/myscript.js') }}
    </body>
</html>