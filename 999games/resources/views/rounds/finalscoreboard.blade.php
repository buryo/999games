@extends('layouts.master')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Toernooipunten</th>
                </tr>
            </thead>
            <tbody>
                @foreach($game as $index => $player)
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $player->users->name }}</td>
                        <td>{{ $player->users->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection