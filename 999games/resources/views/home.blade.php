@extends('layouts.master')

@section('content')
    @auth
        <check-list></check-list>
    @else
        <div class="row justify-content-center">
            <div class="col-6">
                <p>
                    Aan de voet van de Pyreneeën ligt de wereldberoemde Franse vestingstad Carcassonne. De rijke
                    historie van deze unieke plek, van de Romeinen, via de Middeleeuwen tot de Romantiek, diende als
                    inspiratie bij het ontwerpen van een van de populairste bordspellen van deze eeuw:
                </p>

                <h2>Welkom in Carcassonne!</h2>
                <a href="{{route('register')}}">
                    <button class="btn btn-primary mt-3">Wil je inschrijven?</button>
                </a>
            </div>
        </div>
    @endif
@endsection
