@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" ><b>Add new article</b></div>
                    <div class="card-body">
                        <form action="{{route('articles.update',['id'=>$article->id])}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Title:</label>
                                <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{$article->title}}">
                                @error('title')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="body">Description:</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="editor" rows="10" >{{$article->body}}</textarea>
                                @error('body')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="name">Image:</label>
                                <input type="file" name="image" class="image form-control form-control-lg @error('image') is-invalid @enderror" >
                                <input type="hidden" name="image_old" value="{{$article->image}}">
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
                                        @if(in_array($tag->id,$tags_ids))
                                            <option value="{{ $tag->id }}" selected> {{ $tag->name }}</option>
                                        @else
                                            <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
                                        @endif
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
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category" >
                                    @foreach($categories as $category)
                                        @if($category->id == $article->category_id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
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
                                <input type="date" name="created_at" class="form-control form-control-lg @error('created_at') is-invalid @enderror" value="{{$article->created_at}}">
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
                        <div class="row">
                            <div class=" col">
                                <form action="{{ route('articles.destroy', ['id' => $article->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Delete" class="btn btn-danger mt-2">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
    <script>
        ClassicEditor
            .create( function (config)
                {
                    config.enterMode = CKEDITOR.ENTER_BR;
                },
                document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
