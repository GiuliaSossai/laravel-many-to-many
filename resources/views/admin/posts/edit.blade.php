@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Modifica {{ $post->title }}</h1>

    <!-- se ci sono, stampo gli errori -->
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="post">
        @csrf
        @method('PUT')
        <div class="my-5">
            <label for="title" class="form-label">Titolo</label>
            <input 
                type="text" class="form-control @error('title') is-invalid @enderror" 
                id="title" name="title"
                value="{{ old('title', $post->title) }}"
            >
            @error('title')
                <p class="gs-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="content" class="form-label">Testo</label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                id="content" name="content" rows="7"
            >{{ old('content', $post->content) }}
            </textarea>
            @error('content')
                <p class="gs-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label mt-5">Inserisci una categoria</label>
            <select class="form-control" name="category_id" id="category_id">
            <option value="">scegli una categoria:</option>
            @foreach ($categories as $category)
                <option 
                    @if($category->id == old('category_id', $post->category_id)) selected @endif 
                    value="{{$category->id}}"
                >{{$category->name}}
                </option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">submit</button>
        <button type="reset" class="btn btn-secondary mt-4">reset</button>
    </form>
    

      
</div>
@endsection

@section('title')
    Modifica
@endsection