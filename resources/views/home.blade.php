@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
          <div class="post-wrap">

            @if(count($posts) > 0)
              @foreach($posts as $post)

              <div class="post__item">
                <p class="post__item-title">{{ $post->title }}</p>
                @if(file_exists('images/' . $post->img_link) && $post->img_link != null)
                  <img src="images/{{ $post->img_link }}" alt="image" class="post__item-image">
                @endif
                <div class="post__item-info">
                  <span class="post__item-author">{{ $post->author }}</span>
                  <span class="post__item-date">{{ $post->created_at }}</span>
                </div>
                <p class="post__item-text">{{ $post->description }}</p>
              </div>

              @endforeach
            @else
              <h4>No posts yet</h4>
            @endif
            {{ $posts->links() }}
          </div>

        </div>
    </div>
</div>
@endsection
