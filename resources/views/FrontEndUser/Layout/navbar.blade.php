<nav class="navbar navbar-expand-lg white border-bottom p-3 mx-4">
    <div class="container-fluid">
        <a class="navbar-brand cl-dark" href="{{ route('Home') }}">Mini E-commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 cl-dark">
                <li class="nav-item">
                    <a class="nav-link cl-dark" aria-current="page" href="{{ route('Home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cl-dark" href="{{ route('all_product') }}">All product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle cl-dark" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Category Product
                    </a>
                    <ul class="dropdown-menu cl-dark">
                        @foreach ($kategori as $kat )
                        <li><a class="dropdown-item" href="{{ route('product_cat', $kat->slug )}}"> {{ $kat->nama }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
            <div class="menu d-flex gap-4">
                <div data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <div class="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-search"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 cl-dark" id="exampleModalLabel">Search for the product you want</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('all_product') }}">
                                    <div class="mb-3 d-flex gap-4">
                                        <input type="text" class="form-control" id="recipient-name" name="search">
                                        <button type="submit" class="btn btn-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-search"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg>
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <a href="{{ route('cart') }}">
                    <div class="cart">
                        <span class="icon-header-notif" data-notify="">@if(Session::has('cart')) {{
                            count(Session::get('cart')) }} @else 0 @endif</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                            class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                    </div>
                </a>
                <a href="{{ route('user_profile') }}">
                    <div class="profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </div>
                </a>
                <a href="{{ route('login-user') }}" class="btn btn-dark">
                    Log in
                </a>
            </div>
        </div>
    </div>
</nav>
