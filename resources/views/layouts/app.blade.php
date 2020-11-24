<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Navbar -->
      <?php
        $team = App\Team::first();
      ?>
     <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
          <div class="row">
              <a class="navbar-brand contentstitle" href="{{ url('/') }}">{{$team->name}}</a>
              <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item col-3">
                        <a class="navi nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item col-3">
                            <a class="navi nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
          </div>

                @else
                    <div class="row">
                        <li class="nav-item dropdown col-6">
                            <a id="navbarDropdown" class="navi nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span>{{ Auth::user()->number }}：{{ Auth::user()->Name }}<span class="caret"></span>
                            </a>
                          <div class="dropdown-menu dropdown-menu-right col-6" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                              </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </div>
                        </li>
                    </div>
                @endguest
              </ul>
      </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('/') }}">
                            <img src="{{ asset('/storage/img/'.'home.png')}}" width="30">
                            Home
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('team') }}">
                            <img src="{{ asset('/storage/img/'.'team.png')}}" width="30">
                            Team
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('users') }}">
                            <img src="{{ asset('/storage/img/'.'player.png')}}" width="30">
                            Players
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('results') }}">
                          <img src="{{ asset('/storage/img/'.'teamresult.png')}}" width="30">
                          Result
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('table') }}">
                          <img src="{{ asset('/storage/img/'.'playerresult.png')}}" width="30">
                          Records
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('schedules') }}">
                          <img src="{{ asset('/storage/img/'.'schedule.png')}}" width="30">
                          Schedules
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('place') }}">
                          <img src="{{ asset('/storage/img/'.'place.png')}}" width="30">
                          Places
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('blog') }}">
                          <img src="{{ asset('/storage/img/'.'blog.png')}}" width="30">
                          Blog
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="navi nav-link" href="{{ url('album') }}">
                          <img src="{{ asset('/storage/img/'.'camera.png')}}" width="30">
                          Album
                        </a>
                      </li>
                  @guest
                  @else
                        @if(Auth::user()->admin == 0)
                        @else
                            <li class="nav-item">
                              <a class="navi nav-link" href="{{ route('team.admin') }}">
                                <img src="{{ asset('/storage/img/'.'admin.png')}}" width="30">
                                Admin
                              </a>
                            </li>
                        @endif
                  @endguest
                </ul>
              </div>
            </nav>         
    <!-- NavbarEnd -->
  <div class="body">
      <div class="container">
          <div class="row">
              @if(session('status'))
                  <div class="message col-md-11">
                      <div class="card">
                          <div class="card-body">
                              {{ session('status')}}
                          </div>
                      </div>
                  </div>
              @endif
              @if(session('message'))
                  <div class="message col-md-11">
                      <div class="card">
                            {{session('message')}}
                      </div>
                  </div>
              @endif
          @yield('content')
          </div>
      </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
</body>
 <!-- FOOTER -->
 <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-FxkQtQ8fW6C3xA7BoW8ocAb2N7U9dCA7ZJXMJlz/37PL6Q6PUGQ5ZeJcaXdYKcdJ" crossorigin="anonymous"></script></body>
</html>

</html>