<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ecommerce</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              @foreach ($categories as $c )
               <li><a class="dropdown-item" href="{{url('/categories/cproducts/'.$c->name)}}" value={{$c->id}}>{{$c->name}}</a></li>
               <li><hr class="dropdown-divider"></li>
              @endforeach            
              <li><a class="dropdown-item"  href="{{url('/categories/cproducts/')}}">All</a></li>
            </ul>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-danger" type="submit"><i class="bi bi-search"></i> </button>
            </div>       
        </form>

        <ul class="navbar-nav">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else

                   <li class="nav-item">
                        <a class="nav-link" href="{{url('/cart')}}"><i class="bi bi-cart" style="font-size: 25px"></i>
                          <span class="badge rounded-pill text-bg-danger">0</span>           
                        </a>
                    </li>  

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/') }}">  <i class="bi bi-person-circle"></i>Profile</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="{{ url('/') }}">  <i class="bi bi-cart"></i>My Cart</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="{{ url('/') }}">  <i class="bi bi-list"></i>My Orders</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                           <i class="bi bi-arrow-left-circle"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

