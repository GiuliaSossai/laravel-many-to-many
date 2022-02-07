@extends('layouts.admin')

@section('content')
<div class="container">
   <h1>{{ $post->title }}</h1>

   @if ($post->category)
       <h5 class="my-4">categoria: {{ $post->category->name }}</h5>
   @endif

   @forelse ($post->tags as $tag)
        <span class="badge bg-success text-white mb-3">{{ $tag->name }}</span>
    @empty
        -   
    @endforelse
   
   <p>{{ $post->content }}</p>

   <div class="d-flex">
        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">edit</a>    
   
        <form onsubmit="return confirm('Vuoi eliminare: {{$post->title}}')"
            action="{{route('admin.posts.destroy', $post)}}" method="POST"
        >
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger ml-4">delete</button>
        </form>
   </div>
   
</div>
@endsection

@section('title')
    {{ $post->title }}
@endsection