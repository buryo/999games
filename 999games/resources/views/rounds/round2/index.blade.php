@extends('layouts.master')

@section('content')
    <div class="container">
        @if($start_round_2 === false)
            <div>
                <h1>Er worden nog scores verwacht om ronde 2 te starten.</h1>
            </div>
        @else
            <div>
                <form method="post" action="{{ route('round2.store') }}">
                    @csrf
                    <button class="btn btn-primary">Genereer Ronde 2</button>
                </form>
            </div>
        @endif
    </div>
@endsection