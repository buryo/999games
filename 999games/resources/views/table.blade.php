@extends("layouts.master")

@section("title", "Scores invullen")

@section("content")

<div class="container">
    <form action="{{route('game.setScore',$game)}}" method="post">
        @csrf
        <div class="row my-auto">
        @foreach($players as $player)

            <div class="card col" style="width: 10rem; min-height: 10rem;margin-top: 200px">
                <label>{{$player->name}}</label>
                <input style="color: black !important;" type="number" name="user_{{$player->id}}">
            </div>

        @endforeach
        </div>
        <button type="submit">Submit</button>

        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}  </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection