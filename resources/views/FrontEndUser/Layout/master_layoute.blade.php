<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">


</head>

<body class="body">
    @include('FrontEndUser.Layout.navbar')
    <div class="container content-home">
        <div class="content mt-4 mb-5 pb-5">

            <div class="section-content">
                @yield('content')
            </div>

        </div>
    </div>
    <div class="footer p-5 border-top">
        <div class="f-content row">
            <div class="col-md-6">
                <div class="logo-footer">
                    <h3 class="logo cl-dark">Mini E-commerce</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="f-content-menu row">
                    <div class="col-md-6">
                        <p class="f-text">Sosial Media</p>
                        <ul class="menu">
                            <li>Instagram</li>
                            <li>Facebook</li>
                            <li>Twitter</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p class="f-text">Category</p>
                        <ul class="menu">
                            @foreach ($kategori as $kat)
                                 <li><a href="" class="cl-grey">{{ $kat->nama }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>

</html>
