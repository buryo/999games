@extends("layouts.master")

@section("title", "NK carcasonne inloggen")

@section("content")
    <div class="container container-login">
        <div class="row wrapper-login justify-content-center">
            <div class="col-md-7 col-sm-12">
                <h2 class="white-text text-center py-4">
                    Inloggen
                </h2>

                <div class="px-lg-5 pt-0">
                    <form class="text-center" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="md-form">
                            <input type="text" name="email" id="materialUsername" class="form-control"
                                   value="{{ old('email') }}" required>
                            <label for="materialUsername">Email</label>
                            @if ($errors->has('email'))
                                <p class="text-danger text-left"
                                   role="alert">{{ $errors->first('email') }}</p>
                            @endif

                        </div>

                        <div class="md-form">
                            <input type="password" name="password" id="materialName"
                                   class="form-control" required>
                            <label for="materialName">Wachtwoord</label>
                            @if ($errors->has('password'))
                                <p class="text-danger text-left"
                                   role="alert">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                type="submit">Inloggen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
