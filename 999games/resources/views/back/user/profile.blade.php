@extends("layouts.master")

@section("title", "Profiel")

@section("content")
    <div class="container container-login p-5">
        <div class="container-big">
            <div class="row">
                <div class="div-profile-left p-0 col-sm-5 text-center">
                    <!--<img class="img-fluid" src="{{ asset('img/user/profile/'. $user['profile_picture'] ) }}">-->
                    <h5 class="display-4">{{ $user['name'] }} {{ $user['last_name'] }}</h5>
                </div>
                <div class="div-profile-right col-sm-7">
                    <div class="card-deck text-center">
                        <div class="card card-profile border-transparent">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->points}}</h5>
                            </div>
                            <div class="card-footer">
                                <h5 class="card-title">Wedstrijdpunten</h5>
                            </div>
                        </div>
                        @if($user->games()->find("weight") !== null)
                            <div class="card card-profile border-transparent">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->games()->find("weight")}}</h5>
                                </div>
                                <div class="card-footer">
                                    <h5 class="card-title">Gewicht</h5>
                                </div>
                            </div>
                        @endif
                        <div class="card card-profile border-transparent">
                            <div class="card-body">
                                <h5 class="card-title">{{($user->status == 1 ? "Ja" : "Nee")}}</h5>
                            </div>
                            <div class="card-footer">
                                <h5 class="card-title">Speler actief</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card card-profile border-transparent mt-2">
                        <div class="card-body">
                            <h5 class="card-title">Gespeelde potjes</h5>
                        </div>
                        <div class="card-footer">
                            <div id="accordion">
                                @foreach($battles as $index => $battle)

                                    <div class="card rounded-0">
                                        <div class="card-header" role="tab" id="heading{{$index}}">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" href="#collapse{{$index}}" aria-controls="collapse{{$index}}">
                                                    Ronde {{$index + 1}}
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapse{{$index}}" class="collapse {{($loop->first ? "show" : "")}}" role="tabpanel" data-parent="#accordion" aria-labelledby="heading{{$index}}">
                                            <div class="card-body">
                                                @foreach($battle as $players)
                                                    <h5 class="card-title">
                                                        {{$players->User->name}} {{$players->User->last_name}}
                                                        -
                                                        Score: {{($players->score === null ? 0 : $players->score)}}
                                                        -
                                                        Gewicht:
                                                        @php
                                                            $temp = floor(@(100 - ($points[$index] - $players->score) / $points[$index] * 100));
                                                            echo (is_nan($temp) ? "Nog niet gespeeld" : $temp)
                                                        @endphp
                                                    </h5>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
