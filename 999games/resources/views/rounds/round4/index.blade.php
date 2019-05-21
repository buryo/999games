@extends('layouts.master')

@section('content')
    <div class="container">
        @if($start_round_4 === false)
            <div>
                <h1>Er worden nog scores verwacht om ronde 4 te starten.</h1>
            </div>
        @else
            <div>
                <form method="post" action="{{ route('round4.store') }}">
                    @csrf
                    <button class="btn btn-primary">Genereer Ronde 4</button>
                </form>
            </div>
        @endif
    </div>
@endsection