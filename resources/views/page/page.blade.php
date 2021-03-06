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
    use App\Http\Controllers\HomeController;
    echo HomeController::headerNav();
@endphp
<div class="wrapper">
    <p class="link">
        /
        @foreach($categories as $category)
        <a href="{{ $category->currentPath}}">{{ $category["slug"] }}</a>
        /
        @endforeach
        <a href="{{ $category->currentPath }}/{{ $page["slug"] }}">{{ $page["slug"] }}</a>
    </p>
    @if($page->price != null)
    <p>Prijs: {{$page->price}}</p>
    @endif
    <div class="page">
        <div class="page-title-div">
            <h1 class="page-title">{{$page["title"]}}</h1>
            <span class="page-like">
                @if($page_like == null)
                    <a href="{{ url('page/'.$page->id.'/like') }}"><i class="far fa-heart"></i></a>
                @else
                    <a href="{{ url('page/'.$page->id.'/dislike') }}"><i class="fas fa-heart"></i></a>
                @endif
            </span>
        </div>
        <div class="page-content">
            {!! $content !!}
        </div>
    </div>
    @include('includes.footer')
</div>

</body>
</html>
