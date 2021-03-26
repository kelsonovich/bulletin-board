<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Bulletin Board</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset("css/profile-rating.css") }}">
    </head>

    <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal"><a class="p-2 text-dark" href="{{  route('main')  }}">Adverts</a></h5>
            <nav class="my-2 my-md-0 mr-md-3">
                @auth
                    <a class="p-2 text-dark" href="{{ route('advert.create') }}">Create new advert</a>
                    <a class="p-2 text-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name }}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.show', Auth::id()) }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('user.edit', Auth::id()) }}">Edit profile</a>
                        <div class="dropdown-divider"></div>
                        <!-- Very bad decision  to logout -->
                        <form action="/logout" method="POST">
                            @csrf
                            <a class="dropdown-item" ><label for="logout">Log out</label></a>
                            <input type="submit" id="logout" style="display: none">
                        </form>
                    </div>
                @else
                    <a class="p-2 text-dark" href="{{ route('login') }}">Log in</a>
                    <a class="p-2 text-dark" href="{{ route('register') }}">Registration</a>
                @endauth
            </nav>
        </div>

        <div class="container">
            @include('messages.error')
            @yield('content')

            <footer class="pt-4 my-md-5 pt-md-5 border-top">
            </footer>
        </div>
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" ></script>
    </body>
</html>
