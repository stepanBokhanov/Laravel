@if (!empty($plugins = \Froiden\Envato\Functions\EnvatoUpdate::plugins()))
    <div class="col-md-12 m-t-20">
        <h4>{{ucwords(config('froiden_envato.envato_product_name'))}} Official Plugins</h4>

        <div class="row">
            @foreach ($plugins as $item)
                <div class="col-md-12 b-all p-10 m-t-10">
                    <div class="row">
                        <div class="col-xs-2 col-lg-1">
                            <a href="{{ $item['product_link'] }}" target="_blank">
                                <img src="{{ $item['product_thumbnail'] }}" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="col-xs-8 col-lg-5">
                            <a href="{{ $item['product_link'] }}" target="_blank" class="font-bold">{{ $item['product_name'] }}  </a>

                            <p class="font-12">
                                {{ $item['summary'] }}
                            </p>
                        </div>
                        <div class="col-xs-2 col-lg-6 text-right">
                            <a href="{{ $item['product_link'] }}" target="_blank" class="btn btn-md btn-success"><i class="fa fa-arrow-right text-white"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endif
