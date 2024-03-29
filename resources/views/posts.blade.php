@extends('layouts.main')

@section('title', 'Posts')

@section('contain')
<div class="container mb-5" style="margin-top: 80px">
  <div class="row mt-5 mb-3">
    <div class="col-md-11 mx-auto">
      <form action="/posts">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ Request('search') }}">
          <button class="btn btn-success" type="submit">Search</button>
        </div>
      </form>
      @if (Request('category'))
      <input type="hidden" name="category" value="{{ Request('category') }}">
      <h2 class="text-center">Posts Category {{ Request('category') }}</h2>
      <hr>
      @elseif(Request('author'))
      <input type="hidden" name="author" value="{{ Request('author') }}">
      <h2 class="text-center">Posts createt by {{ Request('author') }}</h2>
      <hr>
      @else
      <h2 class="text-center">Posts All</h2>
      <hr>
      @endif
    </div>
  </div>
  @if ($posts->count())
  <hr>
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-4">
        @if ($posts[0]->image)
        <div class="" style="max-height: 350px; overflow: hidden;">
          <img src="{{ asset('storage/' . $posts[0]->image) }}" class="img-fluid" alt="{{ $posts[0]->image }}">
        </div>
        @else
        <img src="https://source.unsplash.com/1700x1000?{{ $posts[0]->category->slug }}" class="img-fluid rounded-start"
          alt="...">
        @endif

      </div>
      <div class="col-md-8 align-content-center my-auto">
        <div class="card-body">
          <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-body">{{
              $posts[0]->title }}</a></h3>
          <small class="px-3 text-muted">
            Post by. <a href="/posts?author={{ $posts[0]->user->username }}" class="text-decoration-none ">{{
              $posts[0]->user->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}">{{
              $posts[0]->category->name }}</a>
          </small>
          <p class="card-text">{!! $posts[0]->excerpt !!}</p>
          <p class="card-muted"><small class="text-muted">Last updated
              {{ $posts[0]->created_at->diffForHumans() }}</small>
          </p>
          <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-success mt-3">Read More..</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    @foreach ($posts->skip(1) as $post)
    <div class="col-md-4 my-3">
      <div class="card" style="width: 99%;">
        @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->image }}">
        @else
        <img src="https://source.unsplash.com/1200x800?{{ $post->category->slug }}" class="card-img-top" alt="">
        @endif
        <a class="btn btn-outline-light position-absolute m-2" style="background-color: rgba(0, 0, 0, 0.3)"
          href="/posts?category={{ $post->category->slug }}" role="button">{{ $post->category->name }}</a>

        <div class="card-body">
          <h5 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-body">{{
              $post->title }}</a></h5>
          <small class="px-3 text-muted">
            by. <a href="/posts?author={{ $post->user->username }}" class="text-decoration-none ">{{ $post->user->name
              }}</a>
          </small>
          <p class="card-muted"><small class="text-muted">Last updated
              {{ $posts[0]->created_at->diffForHumans() }}</small>
          </p>
          <p class="card-text"> {!! $post->excerpt !!} </p>
          <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>
    @endforeach
    <hr>
    <div class="d-flex justify-content-center mb-5">
      @if ($posts->hasPages())
      {{ $posts->links() }}
      @endif
    </div>
  </div>
  @else
  <div class="row mt-5">
    <p class="text-center fs-4">
      Postingan tidak ditemukan.
    </p>
  </div>
  @endif
</div>
@endsection