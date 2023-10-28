@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Blog Title</th>
                        <th>Summary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>
                                <img src="{{ url('/public/storage/' . $blog->image) }}" alt="Blog Image" width="70px" height="100px">
                            </td>
                            <td>{{ $blog->author }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->summary }}</td>
                        
                            <td>
                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('blog.delete', $blog->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

        
        
    </div>
</div>
@endsection
