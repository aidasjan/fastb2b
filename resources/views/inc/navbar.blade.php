<nav class="navbar navbar-expand-lg navbar-dark navbar-laravel shadow-none container_main">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-3">
                @guest
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" style='color: #fff;' href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        
                    @endguest
            </ul>
        </div>
    </div>
</nav>