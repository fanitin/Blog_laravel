@extends('layouts.main')

@section('title', 'Posts')

@section('content')

<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">カテゴリス</h1>
        <section class="featured-posts-section">
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{route('category.post.index', $category->id)}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
        </section>
    </div>
</main>

@endsection