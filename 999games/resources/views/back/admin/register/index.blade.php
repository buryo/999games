@extends("layouts.master")

@section("title", "NK carcasonne")

@section("content")
    <div class="container container-login">
        <div class="row wrapper-login justify-content-center">
            <div class="col-md-7 col-sm-12">
                <h2 class="white-text text-center py-4">
                    Admin Registreren
                </h2>

                <div class="px-lg-5 pt-0">
                    <form class="text-center" method="post" action="{{ route('user.register') }}">
                        @csrf
                        <div class="md-form">
                            <input name="name" type="text" class="form-control" id="materialName" required="required" value="{{ old('name') }}"/>
                            <label for="materialName">Naam</label>
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

                        <div class="md-form">
                            <input type="email" name="email" id="materialEmail" class="form-control" value="{{ old('email') }}" required>
                            <label for="materialEmail">E-mailadress</label>
                            @if ($errors->has('email'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="md-form">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <label for="password">Wachtwoord</label>
                            @if ($errors->has('password'))
                                <p class="text-danger text-left" role="alert">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="md-form">
                            <input class="form-control" name="password_confirmation" type="password" id="password-confirm" required="required"/>
                            <label for="password-confirm">Herhaal wachtwoord</label>
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
