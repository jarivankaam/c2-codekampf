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
@include('includes.header')
<div class="wrapper">
    <p class="link">
        /
        @foreach($categories as $category)
        <a href="{{ $category->currentPath}}">{{ $category["slug"] }}</a>
        /
        @endforeach
        <a href="{{ $category->currentPath }}/{{ $page["slug"] }}">{{ $page["slug"] }}</a>
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
