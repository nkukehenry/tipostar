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
                                @include('widgets.badge',['badge'=>$badge])
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


                    <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">{{__('frontend.performance')}}</a></li>
                    <li><a data-toggle="tab" href="#menu1">{{__('frontend.free_tips')}}</a></li>
                    <li><a data-toggle="tab" href="#menu2">{{__('frontend.premium_tips')}}</a></li>
                    </ul>

                    <div class="tab-content padded">
                    <div id="home" class="tab-pane fade in active">
                        
                        @if( count($tipster->won)>0 )
                            <h4>Wins</h4>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Game</th>
                                        <th>Tipster Prediction</th>
                                        <th>Game Outcome</th>
                                    </tr>
                                </thead>
                                @foreach($tipster->won as $won)
                                <tr>
                                <td>{{ $lost->game->home_team->team_name.' Vs '.$lost->game->away_team->team_name}}</td>
                                <td>{{ $won->outcome->outcome_name}}</td>
                                <td>{{ $won->game->outcome->outcome_name}}</td>
                                </tr>
                                @endforeach
                            </table>
                        @endif

                        @if( count($tipster->lost)>0 )
                        <h4>Losses</h4>
                        <table width="100%">
                           <thead>
                            <tr>
                                <th>Date</th>
                                <th>Game</th>
                                <th>Tipster Prediction</th>
                                <th>Game Outcome</th>
                            </tr>
                            </thead>
                            @foreach($tipster->lost as $lost)
                            <tr>
                            <td>{{ $lost->game->game_date}}</td>
                            <td>{{ $lost->game->home_team->team_name.' Vs '.$lost->game->away_team->team_name}}</td>
                            <td>{{ $lost->outcome->outcome_name}}</td>
                            <td>{{ $lost->game->outcome->outcome_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <h3>Free Tips</h3>
                        <table>
                            @foreach($tipster->lost as $lost)
                            <tr>
                                <td>{{ $lost->game->home_team->team_name.' Vs '.$lost->game->away_team->team_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <h3>Premium</h3>
                        <table>
                            @foreach($tipster->lost as $lost)
                            <tr>
                                <td>{{ $lost->game->home_team->team_name}}</td>
                                <td>{{ $lost->game->away_team->team_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                    </div>
               


            </div>
        </div>
    </div>
</div>
@endsection




