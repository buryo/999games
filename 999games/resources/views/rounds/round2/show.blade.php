@extends('layouts.master')

@section('content')
    <div class="row">
        @if($generated === true)
            <?php $i = 1 ?>
            @foreach($tables as $table)
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4  game-wrapper">
                    <div class="table-wrapper" style="opacity: 1;transform: rotateX(20deg);width: 274px;">
                        <div class="table-surface">
                            <a href="#">
                                <button class="btn text-dark">Kijken!</button>
                            </a>
                        </div>
                        <div class="table"></div>
                    </div>
                    <div class="table-edge" style="opacity: 1; width: 274px;">
                        <div class="table-leg"></div>
                        <div class="table-leg"></div>
                    </div>
                    <h2>Tafel {{$i++}}</h2>
                    <div class="name-tags">
                        @if (count($table) == 4)
                            @foreach($table as $player)
                                <span>{{$player->name}}</span>
                            @endforeach
                        @elseif (count($table) == 3)
                            @foreach($table as $player)
                                <span>{{$player->name}}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @elseif($generated === false)
            @foreach($games as $table)
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4  game-wrapper">
                    <div class="table-wrapper" style="opacity: 1;transform: rotateX(20deg);width: 274px;">
                        <div class="table-surface">
                            <a href="#">
                                <button class="btn text-dark">Kijken!</button>
                            </a>
                        </div>
                        <div class="table"></div>
                    </div>
                    <div class="table-edge" style="opacity: 1; width: 274px;">
                        <div class="table-leg"></div>
                        <div class="table-leg"></div>
                    </div>
                    <h2>Tafel {{ $table->table }}</h2>
                </div>
            @endforeach
        @else
            {{ redirect()->route('round2.index') }}
        @endif
    </div>
@endsection
