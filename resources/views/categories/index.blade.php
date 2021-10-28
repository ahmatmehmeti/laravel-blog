@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Categories</b></div>
                <div class="card-body" >
                    <table class="table table-bordered">
                        <thead  style="background-color: ghostwhite;">
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td> <a href="{{ route('categories.edit', ['id' => $category->id])  }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><b>Add new category</b></div>
                <div class="card-body">
                    <form action="{{route('categories.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-success btn-block mt-1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


