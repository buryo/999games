@extends('layouts.master')

@section('content')
    <div class="container">
        @if($start_round_3 === false)
            <div>
                <h1>Er worden nog scores verwacht om ronde 3 te starten.</h1>
            </div>
        @else
            <div>
                <form method="post" action="{{ route('round3.store') }}">
                    @csrf
                    <button class="btn btn-primary">Genereer Ronde 3</button>
                </form>
            </div>
        @endif
    </div>
@endsection