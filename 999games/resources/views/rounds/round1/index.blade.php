@extends('layouts.master')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('round1.store') }}">
            @csrf
            <button class="btn btn-primary">Genereer Ronde 1</button>
        </form>
    </div>
@endsection
