<nav class="display-table-cell v-align box position-fixed d-sm-none d-md-block" id="navigation">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{asset('img/logo.png')}}">
        </a>
    </div>
    <div class="navi">
        <ul>
            <li class="{{ Route::currentRouteName() == 'home' ? 'active' : ''  }}"><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
            @guest
                <li class="{{ Route::currentRouteName() == 'leaderboard' ? 'active' : ''  }}"><a href="{{ route('leaderboard') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Leaderboard</a></li>
            @endguest
            @auth
                <li class="{{ Route::currentRouteName() == 'attendance' ? 'active' : ''  }}"><a href="{{ route('attendance') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Scorebord</a></li>
                <li class="{{ Route::currentRouteName() == 'attendance' ? 'active' : ''  }}"><a href="{{ route('round1.show', 1) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Ronde 1</a></li>
                <li class="{{ Route::currentRouteName() == 'attendance' ? 'active' : ''  }}"><a href="{{ route('round2.show', 2) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Ronde 2</a></li>
                <li class="{{ Route::currentRouteName() == 'attendance' ? 'active' : ''  }}"><a href="{{ route('round3.show', 3) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Ronde 3</a></li>
                <li class="{{ Route::currentRouteName() == 'attendance' ? 'active' : ''  }}"><a href="{{ route('round4.show', 4) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Ronde 4</a></li>
            @endauth
            <li class="{{ Route::currentRouteName() == 'register' ? 'active' : ''  }}"><a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>Inschrijven</a></li>
        </ul>

        <ul class="nav-login">
            @auth
                <li class="{{ Route::currentRouteName() == 'user.register' ? 'active' : ''  }}"><a href="{{ route('user.register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Admin Registreren</a></li>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>Loguit
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li><a href="{{route('login')}}"><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
            @endauth
        </ul>
    </div>
</nav>
