@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="{{ route('home')}}" class="list-group-item list-group-item-action active">Categories</a>
                    @foreach($categories as $category)
                        <a href="{{route('category',['id'=>$category->id])}}"
                           class="list-group-item list-group-item-action">{{$category->name}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="row col-md-10">
                <div class="text-center"></div>
                @foreach($articles as $article)
                    <div class='col-md-3' style="margin-bottom: 5px">
                        <div class='panel panel-info'>
                            <div class='panel-body'>
                                <img src="{{asset('images/' . $article->image)}}" style="width: 200px;height: 300px;">
                                <h5>{{$article->title}}</h5>
                                <a href="{{route('articles.show',['id'=>$article->id])}}"
                                   class="btn btn-outline-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="links text-center">

                </div>
            </div>
        </div>
    </div>

@endsection
