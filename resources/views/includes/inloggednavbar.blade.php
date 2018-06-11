<header class="header">
    <div class="container-fluid">

        <div class="row">
            <div class="navbar-wrap flex-row space-between main-nav">
                <!-- <div class="logo-wrap">
                    <a href="{{ URL::to('/') }}"><img src="{{ asset('img/rdc_logo.png') }}" alt="logo" class="contained-img"></a>
                </div> -->
                <div id="navbar" class="navbar-collapse collapse">

                </div>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <img src="{{asset('img/hamburger.png')}}" class="img-responsive hamburger-icon">
                </button>
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <li style='list-style-type: none;' class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                        <!-- <a href="{{ route('login') }}">Login</a> -->
                        <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                </div>
            @endif
            </div>
        </div>


    </div>
</header>
