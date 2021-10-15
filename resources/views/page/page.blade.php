<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
    <title>C2-codecamp</title>
    <style>
        :root {
            --page-color: {{ $page["color"] }};
        }
    </style>
</head>
<body>
@php
    use App\Http\Controllers\homeController;
    echo homeController::categoryInclude();
@endphp
<div class="wrapper">
    <p class="link">
        /
        <a href="/{{ $category["slug"] }}">{{ $category["slug"] }}</a>
        /
        <a href="/{{ $category["slug"] }}/{{ $page["slug"] }}">{{ $page["slug"] }}</a>
    </p>
    <div class="page">
        <h1 class="page-title">{{$page["title"]}}</h1>
        <div class="page-content">
            {!! $content !!}
        </div>
    </div>
</div>
</body>
</html>
