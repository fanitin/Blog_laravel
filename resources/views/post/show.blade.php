@extends('layouts.main')

@section('title')
    {{$post->title}}
@endsection

@section('content')

<main class="blog-post">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{$post->title}}</h1>
        <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200"> <span>{{$date->format('F d, Y').' '. $date->format('H:i').' '. $post->comments->count().' comments'}}</span></p>
        <section class="blog-post-featured-img d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
            <img src="{{ asset('storage/'.$post->main_image) }}" alt="main image" class="img-fluid rounded">
        </section>
        <section class="post-content">
            <div class="row">
                <div class="col-lg-9 mx-auto blog-content" data-aos="fade-up">
                    {!! $post->content !!}
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <section class="py-4">
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
                </section>

                @if ($relatedPosts->count() > 0)
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                        <div class="row">
                            @foreach ($relatedPosts as $relatedPost)
                            <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                <img src="{{asset('storage/'.$relatedPost->preview_image)}}" alt="related post" class="post-thumbnail">
                                <p class="post-category">{{$relatedPost->category->name}}</p>
                                <a href="{{ route('post.show', $relatedPost->id)}}"><h5 class="post-title">{{$relatedPost->title}}</h5></a>
                            </div>
                            @endforeach
                        </div>
                    </section>
                @endif
                @auth
                    <section class="comment-section">
                    <h2 class="section-title mb-5" data-aos="fade-up">Leave a comment</h2>
                    <form action="{{route('post.comment.store', $post->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12" data-aos="fade-up">
                            <label for="comment" class="sr-only">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" placeholder="Comment" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" data-aos="fade-up">
                                <input type="submit" value="Send Message" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </section>
                @endauth
                <section class="mb-5">
                    <h2 class="section-title mb-5" data-aos="fade-up">Comments ({{$post->comments->count()}})</h2>
                    @foreach ($post->comments as $comment)
                        <hr>
                        <div class="comment-text m-4">
                          <span class="username">
                            <div>
                                {{$comment->user->name}}
                            </div>
                            <span class="text-muted float-right">{{$comment->date_as_carbon->diffForHumans()}}</span>
                          </span><!-- /.username -->
                          <p>
                            {{$comment->comment}}
                          </p>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
</main>

@endsection