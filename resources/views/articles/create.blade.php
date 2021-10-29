@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" ><b>Add new article</b></div>
                <div class="card-body">
                    <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title:</label>
                            <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="">
                            @error('title')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="body">Description:</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="editor" rows="10"></textarea>
                            @error('body')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="name">Image:</label>
                            <input type="file" name="image" class="image form-control form-control-lg @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="tags">Tags:</label>
                            <select multiple="multiple" class="form-control multiple @error('tags') is-invalid @enderror" name="tags[]" id="tags">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="category">Category:</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="name">Select Date:</label>
                            <input type="datetime-local" name="created_at" class="form-control form-control-lg @error('created_at') is-invalid @enderror">
                            @error('created_at')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit"  class="btn btn-primary mt-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
