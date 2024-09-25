@extends('layouts.main')

@section('title', 'Posts')

@section('content')

<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{$category->name}}</h1>
        <div>
            <a href="{{route('category.index')}}" class="text-success size-20">Back to categories</a>
            <h4 data-aos="fade-up" class="text-center mb-5">{{$posts->count()}} posts</h4>
        </div>
        
        <section class="featured-posts-section">
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                    <div class="blog-post-thumbnail-wrapper">
                        <img src="{{ asset('storage/'.$post->preview_image) }}" alt="blog post">
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="blog-post-category">{{isset($post->category) ? $post->category->name : 'NO CATEGORY'}}</p>
                        @auth
                            <form action="{{ route('post.like.store', $post->id)}}" method="POST">
                            @csrf
                            <span>{{$post->likedUsers->count()}}</span>
                            <button type="submit" class="border-0 bg-transparent">
                                @if (auth()->user()->likedPosts->contains($post))
                                    <i class="fas fa-solid fa-heart"></i>
                                @else
                                    <i class="far fa-regular fa-heart"></i>
                                @endif
                            </button>
                        </form>
                        @endauth
                        @guest
                        <div>
                            <span>{{$post->likedUsers->count()}}</span>
                            <i class="far fa-regular fa-heart"></i>
                        </div>
                        @endguest
                    </div>
                    <a href="{{ route('post.show', $post->id)}}" class="blog-post-permalink">
                        <h6 class="blog-post-title">{{$post->title}}</h6>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="mx-auto" style="margin-top: -90px">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    </div>

</main>

@endsection