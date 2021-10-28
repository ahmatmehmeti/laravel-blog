@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class='panel-body'>
                                        <img src="{{asset('images/' . $article->image)}}"
                                             style="width: 200px;height: 300px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='panel-heading'><h3></h3></div>
                                    <p><b>Description:</b> {{$article->body}} </p><br>
                                </div>
                                <div class="col-md-3">
                                    <p><b>Category: </b> {{$article->category->name}}</p><br>

                                    <p><b>Publish date:</b> {{date("d-m-Y",strtotime($article->created_at))}} </p><br>
                                    @foreach($article->tags as $tag)
                                    <button type="button" class="btn btn-secondary btn-sm">{{$tag->name}}</button>
                                    @endforeach
                                </div>
                            </div>
                            <br>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

