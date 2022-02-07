@extends('layouts.admin')

@section('content')
<div class="container">
   <h1>Lista dei post</h1>

   @if (session('deleted'))
      <p class="alert alert-success my-3" role="alert"> {{ session('deleted') }} </p>
    @endif

    <table class="table my-5">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">titolo</th>
                <th scope="col">testo</th>
                <th scope="col">tag</th>
                <th scope="col" colspan="4">categoria</th>
                <!-- <th scope="col">slug</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        @forelse ($post->tags as $tag)
                        <span class="badge bg-success text-white">{{ $tag->name }}</span>
                        @empty
                            -   
                        @endforelse
                    </td>
                    <td>
                        @if ($post->category)
                            {{$post->category->name}}
                        @else
                            -
                        @endif
                    </td>
                    <!-- <td>{{ $post->slug }}</td> -->
                    <td><a href="{{ route('admin.posts.show', $post) }}" class="btn btn-primary">show</a></td>
                    <td><a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">edit</a></td>

                    <td>
                        <form 
                            action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                            onsubmit="return confirm('Confermi l\'eliminazione di {{$post->title}}?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>   
                  </td>
                </tr>
            @endforeach    
        </tbody>
    </table>

    <div class="my-4">
        {{ $posts->links() }}
    </div>

    <div>
        @foreach ($categories as $category)
        <h2 class="my-3">{{ $category->name }}</h2>
        <ul>
            @forelse ($category->posts as $post->category)
                <li>
                    <a href="{{ route('admin.posts.show', $post) }}">{{ $post->category->title }}</a>
                </li>    
            @empty
                <li>Nessun post da visualizzare</li>
            @endforelse
        </ul>
            
        @endforeach
    </div>
        
    
</div>
@endsection

@section('title')
    Lista dei post
@endsection
