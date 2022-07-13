<div id="pricing" class="pricing-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-left">
                    <h3>Top Tipsters</h3>
                </div>
            </div>
        </div>
        <div class="row carousel">
            @foreach($tipsters as $tipster)
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="tipster">

                    @foreach($tipster->badges as $badge)
                       @include('widgets.badge',$badge)
                    @endforeach

                    <div class="img-circle" style="background-image: url({{ asset($tipster->photo) }})">
                    @if($tipster->is_sponsored)
                     <div class="tipster-badge">Trusted</div>
                    @endif
                    </div>
                    <div class="tipster-name">{{$tipster->name}}</div>
                    <div class="tipster-min-pricing">
                        <div class="cost">From UGX {{ number_format(1000) }}</div>
                        <div class="win-rate">{{$tipster->win_rate}}</div>
                    </div>
                    @guest
                    <a href="{{ route('register')}}" class="subscribe-button">{{ __('frontend.subscribe')}}</a>
                    @else
                    <a href="{{ route('subscribe',$tipster->id)}}" class="subscribe-button">{{ __('frontend.subscribe')}}</a>
                    @endguest
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>