<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('acp/frontend/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    @yield('css')
    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        Nyayomat
    </title>
</head>

<body>

    <!--Begin::Header-->
    <header>
        <nav class="navbar navbar-light py-3">
            <div class="container">
                <div class="col-md-6">
                    <img src="{{ asset('acp/frontend/Images/logo.png') }}">
                </div>
                <div class="col-md-6">
                    <div class="d-flex search">
                        <div class="input-group me-4">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" style=" fill:#353535;" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></span>
                        </div>
                        <button type="button" class="py-2 px-3 border bg-white me-3">
                            <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                        </button>
                        <button type="button" class="btn btn-lg btn-blue text-white fs-6 rounded">Login</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!--end::Header-->
@yield('content')

