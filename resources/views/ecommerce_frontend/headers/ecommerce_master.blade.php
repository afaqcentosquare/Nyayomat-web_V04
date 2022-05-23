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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css"
        integrity="sha512-wcKDxok85zB8F9HzgUwzzzPKJhHG7qMfC7bSKrZcFTC2wZXVhmgKNXYuid02cHVnFSC8KOJCXQ8M83UVA7v5Bw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @yield('css')
    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        Nyayomat
    </title>
    <style>
        .product-info-qty {
            background: #fff;
            height: 33px;
            width: 32px;
            line-height: 33px;
            float: left;
            display: block;
            text-align: center;
            padding: 0;
            border: none;
        }

        .product-info-qty-input {
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            width: 45px;
        }

        .quantity-border {
            border: 1px solid #ccc;
        }

        
.irs,
.irs-line {
	position: relative;
	display: block
}

.irs,
.irs-bar,
.irs-bar-edge,
.irs-line {
	display: block
}

.irs {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none
}

.irs-line {
	overflow: hidden;
	outline: 0!important
}

.irs-line-left,
.irs-line-mid,
.irs-line-right {
	position: absolute;
	display: block;
	top: 0
}

.irs-line-left {
	left: 0;
	width: 11%
}

.irs-line-mid {
	left: 9%;
	width: 82%
}

.irs-line-right {
	right: 0;
	width: 11%
}

.irs-bar,
.irs-shadow {
	position: absolute;
	width: 0;
	left: 0
}

.irs-bar-edge {
	position: absolute;
	left: 0
}

.irs-shadow {
	display: none
}

.irs-from,
.irs-max,
.irs-min,
.irs-single,
.irs-slider,
.irs-to {
	display: block;
	position: absolute;
	cursor: default
}

.irs-slider {
	z-index: 1
}

.irs-slider.type_last {
	z-index: 2
}

.irs-min {
	left: 0
}

.irs-max {
	right: 0
}

.irs-from,
.irs-single,
.irs-to {
	top: 0;
	left: 0;
	white-space: nowrap
}

.irs-grid {
	position: absolute;
	display: none;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 20px
}

.irs-with-grid .irs-grid {
	display: block
}

.irs-grid-pol {
	position: absolute;
	top: 0;
	left: 0;
	width: 1px;
	height: 8px
}

.irs-grid-pol.small {
	height: 4px
}

.irs-grid-text {
	position: absolute;
	bottom: 0;
	left: 0;
	white-space: nowrap;
	text-align: center;
	font-size: 9px;
	line-height: 9px;
	padding: 0 3px
}

.irs-disable-mask {
	position: absolute;
	display: block;
	top: 0;
	left: -1%;
	width: 102%;
	height: 100%;
	cursor: default;
	background: rgba(0, 0, 0, 0);
	z-index: 2
}

.irs-disabled {
	opacity: .4
}

.lt-ie9 .irs-disabled {
	filter: alpha(opacity=40)
}

.irs-hidden-input {
	position: absolute!important;
	display: block!important;
	top: 0!important;
	left: 0!important;
	width: 0!important;
	height: 0!important;
	font-size: 0!important;
	line-height: 0!important;
	padding: 0!important;
	margin: 0!important;
	outline: 0!important;
	z-index: -9999!important;
	background: 0 0!important;
	border-style: solid!important;
	border-color: transparent!important
}

.irs-from,
.irs-max,
.irs-min,
.irs-single,
.irs-to {
	font-size: 10px;
	line-height: 1.333;
	text-shadow: none
}

.irs-bar,
.irs-bar-edge,
.irs-line-left,
.irs-line-mid,
.irs-line-right,
.irs-slider {
	background: url({{asset('themes/default/assets/img/sprite-skin-flat.png')}}) repeat-x
}

.irs {
	height: 40px
}

.irs-with-grid {
	height: 60px
}

.irs-line {
	height: 12px;
	top: 25px
}

.irs-line-left {
	height: 12px;
	background-position: 0 -30px
}

.irs-line-mid {
	height: 12px;
	background-position: 0 0
}

.irs-line-right {
	height: 12px;
	background-position: 100% -30px
}

.irs-bar {
	height: 12px;
	top: 25px;
	background-position: 0 -60px
}

.irs-bar-edge {
	top: 25px;
	height: 12px;
	width: 9px;
	background-position: 0 -90px
}

.irs-shadow {
	height: 3px;
	top: 34px;
	background: #000;
	opacity: .25
}

.lt-ie9 .irs-shadow {
	filter: alpha(opacity=25)
}

.irs-slider {
	width: 16px;
	height: 18px;
	top: 22px;
	background-position: 0 -120px
}

.irs-slider.state_hover,
.irs-slider:hover {
	background-position: 0 -150px
}

.irs-max,
.irs-min {
	color: #999;
	top: 0;
	padding: 1px 3px;
	background: #e1e4e9;
	-moz-border-radius: 4px;
	border-radius: 4px
}

.irs-from,
.irs-single,
.irs-to {
	color: #fff;
	padding: 1px 5px;
	background: #ed5565;
	-moz-border-radius: 4px;
	border-radius: 4px
}

.irs-from:after,
.irs-single:after,
.irs-to:after {
	position: absolute;
	display: block;
	content: "";
	bottom: -6px;
	left: 50%;
	width: 0;
	height: 0;
	margin-left: -3px;
	overflow: hidden;
	border: 3px solid transparent;
	border-top-color: #ed5565
}

.irs-grid-pol {
	background: #e1e4e9
}

.irs-grid-text {
	color: #999
}

    </style>
</head>

<body>
    @include('ecommerce_frontend.headers.ecommerce_header')
    @yield('content')
    @include('ecommerce_frontend.footer')
