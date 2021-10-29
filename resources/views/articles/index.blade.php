@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Articles</b>
                <a href="{{route('articles.create')}}" class="btn btn-primary">Add New</a>
                    @csrf
                </div>

                <div class="card-body">
                    <div class="text-center"></div>
                    <table class="table table-stripped table-hover table-bordered">
                        <thead  style="background-color: ghostwhite;">
                            <tr>
                                <th>*</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td> {{$article->id}} </td>
                                <td> {{$article->title}} </td>
                                <td> {!!$article->body!!} </td>
                                <td class="text-center">
                                    @if(Auth::user()->role == 'admin' && $article->status == 0)
                                        <a href="{{route('articles.approve',['id'=>$article->id])}}" class="btn btn-warning ;">Approve</a>
                                        <a href="{{route('articles.edit', ['id'=>$article->id])}}" target="_blank" class="btn btn-warning ;">Edit</a>
                                    @else
                                        <a href="{{route('articles.edit', ['id'=>$article->id])}}" target="_blank" class="btn btn-warning ;">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-2">
        {!! $articles->links(); !!}
    </div>
</div>
@endsection
