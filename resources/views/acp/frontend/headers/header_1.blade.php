<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('acp/frontend/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <title>
        @isset($title)
        {{$title}} |
        @endisset
         Nyayomat
        </title>
</head>

<body>
    
    <!--Begin::Header-->
    <header>
        <nav class="navbar navbar-light py-3">
            <div class="container">
                <a href="{{route('homepage')}}"><img src="{{asset('acp/frontend/Images/logo.png')}}"></a>
                @if (Route::currentRouteName() != 'assetprovider.set.passwordview' || Route::currentRouteName() != 'superadmin.login')
                <div>
                    <a href="{{route('login')}}"  class="btn btn-blue text-white fs-6 me-2">Merchant Login</a>
                    <a href="{{route('assetprovider.loginview')}}"  class="btn btn-blue text-white fs-6 me-2">Partner Login</a>
                    <a href="{{route('customer.signin')}}" class="btn btn-orange text-white fs-6 rounded">Customer Login</a>
                    <!-- <a href="#" class="bg-secondary">Merchant & Partner Login</a>
                <a href="#" class="bg-warning">Customer Login</a> -->
                </div>
                @endif
            </div>
        </nav>
    </header>
    <!--end::Header-->