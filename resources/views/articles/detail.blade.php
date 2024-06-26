@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    Category : <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @can('article-delete', $article)
                    <a class="btn btn-warning" href="{{ url("/articles/delete/$article->id") }}">
                        Delete
                    </a>
                @endcan
            </div>
        </div>

        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @can('comment-delete',$comment)
                        <a href="{{ url("/comment/delete/$comment->id") }}" class="btn-close float-end">
                        </a>
                    @endcan
                    {{ $comment->content }}
                    <div class="small mt-2">
                        By <b>{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>
        @auth
            <form action="{{ url('/comment/add') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection
