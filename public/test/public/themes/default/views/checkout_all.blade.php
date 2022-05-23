@extends('layouts.main')

@section('content')
    <!-- breadcrumb -->
    @include('headers.checkout_page')

    <!-- CONTENT SECTION -->
    @include('contents.checkout_all_page')

    <div class="space30"></div>
@endsection

@section('scripts')
    @include('scripts.checkout_all')
@endsection