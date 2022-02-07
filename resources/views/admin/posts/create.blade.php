@extends('layouts.admin')

@section('content')
<div class="container">
   <h1>Inserisci un nuovo post</h1>

   @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <div class="my-5">
            <label for="title" class="form-label">Titolo</label>
            <input 
                type="text" class="form-control @error('title') is-invalid @enderror" 
                id="title" name="title"
                value="{{ old('title') }}"
            >
            @error('title')
                <p class="gs-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="form-label">Testo</label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                id="content" name="content" rows="7"
            >{{ old('content') }}
            </textarea>
            @error('content')
                <p class="gs-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label mt-5">Inserisci una categoria</label>
            <select class="form-control" name="category_id" id="category_id">
            <option value="">scegli una categoria</option>
            @foreach ($categories as $category)
                <option 
                    @if($category->id == old('category_id')) selected @endif 
                    value="{{$category->id}}"
                >{{$category->name}}
                </option>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <h5 class="mt-5">Tag</h5>

            @foreach ($tags as $tag)
                <span class="d-inline-block mr-3">
                    <!-- checkbox fanno tutti parte dello stesso array quindi uso tags[] come name-->
                    <!-- il value deve corrispondere all'id del tag -->
                    <!-- dentro loop foreach posso usare variabile $loop con le sue proprietà tra cui iteration -->
                    <!-- se sbaglio a compilare il form e faccio submit, non voglio perdere le info della checkbox: uso old(). quindi devo far stampare la classe checked solo se c'era l'old; devo anche dare un valore di default, ovvero un array vuoto -->
                    <input type="checkbox" 
                        name="tags[]" 
                        id="tag{{ $loop->iteration }}"
                        value="{{ $tag->id }}"
                        @if(in_array($tag->id, old('tags', []))) checked @endif
                    >
                    <!-- il for della label si riferisce all'id dell'input -->
                    <label for="{{ $loop->iteration }}">{{ $tag->name }}</label>
                </span>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-4">submit</button>
        <button type="reset" class="btn btn-secondary mt-4">reset</button>
    </form>
    
</div>
@endsection

@section('title')
    Nuovo post
@endsection