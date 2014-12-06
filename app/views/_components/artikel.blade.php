<div class="row">
    <div class="col-md-12">
        <h4>Pencarian</h4>
        {{ Form::open(array('route' => array('cari'),'method' => 'get')) }}
            <div class="input-group">
                {{ Form::text('q',null,array('class' => 'form-control', 'placeholder' => 'Masukkan kata kunci'))}}
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                 </span>
            </div>
        {{ Form::close() }}
    </div>
</div>

@if(!$artikels->isEmpty())
    <?php $i = 0; ?>
    @foreach($artikels as $artikel)
        @if($i % 3 == 0 || $i == 0)
           <div class="row">
        @endif
                <div class="col-md-4 col-sm-6 ">
                    <div class="blog-post shadow">
                        @if(!empty($artikel->gambar) && is_file("images_artikel/{$artikel->gambar}"))
                            {{ HTML::image('images_artikel/'.$artikel->gambar, $artikel->judul, array(
                                'class' => 'post-image')) }}
                        @endif
                        <div class="post-title" >
                            <h3 >{{ link_to_route('detail_artikel', $artikel->judul, array($artikel->id)) }}</h3>
                        </div>
                        <div class="post-summary">
                            <div class="date" style="font-size: 14px;color: #017ebc;padding-bottom:10px">
                                <?php $date = new Date($artikel->created_at); ?>
                                <i class="fa fa-fw fa-clock-o"></i> {{ $date->format('l, j F Y, H:i:s') }}
                            </div>
                            <p>{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $artikel->content),200) }}</p>
                        </div>
                        <div class="post-more">
                            {{ link_to_route('detail_artikel', 'Selengkapnya', array($artikel->id),array('class' => 'btn btn-small')) }}
                        </div>
                    </div>
                </div>
        <?php $i++; ?>
        @if($i % 3 == 0 || $i == $artikels->count())
            </div>
        @endif
    @endforeach
@else
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="blog-post">
                <div class="post-summary">
                    <h3>Belum terdapat artikel</h3>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- pagination -->
<div class="row">
    <div class="col-md-12 col-sm-12 pagination-wrapper">
        @if(!empty($key))
            {{ $artikels->appends(array('q' => $key))->links() }}
        @else
            {{ $artikels->links() }}
        @endif
    </div>
</div>
<!-- /pagination -->