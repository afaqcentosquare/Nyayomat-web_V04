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
    <title>Nyayomat</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light pt-4">
            <div class="container">
            <a href="{{route('homepage')}}"><img src="{{asset('acp/frontend/Images/logo.png')}}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active blue-text" aria-current="page" href="{{route('boost.landing.page')}}">Merchant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link blue-text" href="{{route('partnerwithus')}}">Partner with us</a>
                    </li>
                </ul>
                <!-- <button type="button" class="btn btn-blue text-white fs-6">Merchant & Partner Login</button> -->
                <div>
                <a href="{{route('merchant.login')}}"  class="btn btn-blue text-white fs-6 me-2">Merchant Login</a>
                    <a href="https://acp.nyayomat.com/"  class="btn btn-blue text-white fs-6 me-2">Partner Login</a>
                    </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
