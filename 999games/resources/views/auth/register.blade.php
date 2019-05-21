@extends("layouts.master")

@section("title", "NK carcasonne registreren")

@section("content")
    <div class="container container-login">
        <div class="row wrapper-login justify-content-center">
            <div class="col-md-7 col-sm-12">
                <h2 class="white-text text-center py-4">
                    Registreren
                </h2>

                <div class="px-lg-5 pt-0">
                    <form class="text-center" method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="md-form">
                            <input type="text" name="username" id="materialUsername" class="form-control" value="{{ old('username') }}" required>
                            <label for="materialUsername">Gebruikersnaam</label>
                            @if ($errors->has('username'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('username') }}</p>
                            @endif

                        </div>

                        <div class="md-form">
                            <input type="text" name="name" id="materialName" class="form-control" value="{{ old('name') }}" required>
                            <label for="materialName">Voornaam</label>
                            @if ($errors->has('name'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="md-form">
                            <input type="text" name="last_name" id="materialLastName" class="form-control" value="{{ old('last_name') }}" required>
                            <label for="materialLastName">Achternaam</label>
                            @if ($errors->has('last_name'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>

                        {{--<div class="text-center">--}}
                            {{--<a href="#" class="link-999-white">Algemene voorwaarden</a>--}}
                            {{--<input id="accepted" type="checkbox" class="checkbox-999" name="accepted" required>--}}
                        {{--</div>--}}
                        {{--<button type="submit" class="btn-999 btn-999-green btn-lg btn-block">Registreren</button>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6 .d-sm-none .d-md-block div-login-right text-center">--}}
                {{--<img class="img-fluid m-5" src="/img/logo.jpg">--}}
                {{--<!-- TODO: Find bigger logo -->--}}
                {{--<h1 class="mb-5">NK Carcasonne</h1>--}}
                {{--<h3 class="mb-3">Registratieformulier <br> voor spelers</h3>--}}
                {{--@foreach ($errors->all() as $err)--}}
                    {{--<div class="alert alert-danger text-left align-middle"><i class="fas fa-times-circle fa-lg"></i> {{$err}}</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
                        <div class="md-form">
                            <input type="email" name="email" id="materialEmail" class="form-control" value="{{ old('email') }}" required>
                            <label for="materialEmail">E-mailadress</label>
                            @if ($errors->has('email'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                type="submit">Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
