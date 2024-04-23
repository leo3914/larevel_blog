@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        {{ $articles->links('pagination::bootstrap-5') }}
        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="card-subtitle mb-2 text-muted small">
                        <b class="font-bold mb-1">By {{ $article->user->name }} :</b>
                        {{ $article->created_at->diffForHumans() }}
                    </div>
                    <p class=" card-text">
                        {{ $article->body }}
                    </p>
                    <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">View Detail &raquo;</a>
                    @can('article-delete',$article)
                        <a class="card-link btn-danger" href="{{ url("/articles/delete/$article->id") }}">Delete &raquo;</a>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
@endsection
