@extends('layouts.frontend.index')

@section('content')
<!-- Start contact Area -->
<div id="contact" class="contact-area">
    <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">

            <div class="row">
                <!-- Start contact icon column -->
                <div class="col-md-4 col-sm-3 col-xs-12">
                    <div class="contact-icon text-center">
                        <div class="single-icon">
                           <img class="rounded" src="{{$tipster->photo}}" width="100px"/>
                           
                            @foreach($tipster->badges as $badge)
                                @include('widgets.badge',$badge)
                            @endforeach
                        </div>
                    </div>
                </div>
             
                <!-- Start contact icon column -->
                <div class="col-md-8 col-sm-9 col-xs-12">
                  <h3>{{$tipster->name}}</h3>
                  <h3 class="text-success">Win rate: {{$tipster->win_rate}}</h3>
                  

                </div>
            </div>
            <div class="row">
               


            </div>
        </div>
    </div>
</div>
@endsection




