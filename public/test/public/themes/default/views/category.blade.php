@extends('layouts.main')
@section('content')

    <!-- HEADER SECTION -->
    @include('headers.category_page', ['category' => $category])

    <!-- CONTENT SECTION -->
    @include('contents.category_page')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- bottom Banner -->
    @include('banners.bottom')
@endsection